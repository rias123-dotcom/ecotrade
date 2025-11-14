<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Message;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    // Show the messaging UI
    public function index()
    {
        // load list of conversations (distinct partner ids)
        $userId = Auth::id();

        // get last message per conversation partner (simplified)
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function ($m) use ($userId) {
                return $m->sender_id == $userId ? $m->recipient_id : $m->sender_id;
            })
            ->map(function ($group, $partnerId) {
                return $group->first(); // most recent message
            });

        return view('trader.messages', [
            'conversations' => $conversations,
            'userId' => $userId
        ]);
    }

    // Send message (POST)
    public function send(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|integer|exists:users,id',
            'body' => 'required|string|max:5000'
        ]);

        $senderId = Auth::id();
        $recipientId = (int) $request->input('recipient_id');


        // Encrypt the message body
        $encrypted = Crypt::encryptString($request->input('body'));

        // conversation_key: deterministic for the pair (optional, helps grouping)
        $conversationKey = $this->conversationKey($senderId, $recipientId);

        $message = Message::create([
            'sender_id' => $senderId,
            'recipient_id' => $recipientId,
            'body_encrypted' => $encrypted,
            'conversation_key' => $conversationKey,
            'read' => false,
        ]);

        // Optionally: broadcast event or push notification here

        return response()->json([
            'status' => 'ok',
            'message_id' => $message->id,
            'created_at' => $message->created_at->toDateTimeString(),
        ]);
    }

    // Get conversation messages between authenticated user and partner
    public function conversation($partnerId, Request $request)
    {
        $userId = Auth::id();
        $partnerId = (int) $partnerId;

        // authorization: ensure user is participant
        // (If you want only matched traders allowed, check here.)
        if ($partnerId === $userId) {
            return response()->json(['error' => 'Invalid conversation'], 400);
        }

        $messages = Message::where(function ($q) use ($userId, $partnerId) {
                $q->where('sender_id', $userId)->where('recipient_id', $partnerId);
            })
            ->orWhere(function ($q) use ($userId, $partnerId) {
                $q->where('sender_id', $partnerId)->where('recipient_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Decrypt only for authorized user
        $payload = $messages->map(function ($m) use ($userId) {
            // You could decrypt only for the requesting user; both sender & recipient allowed
            try {
                $plaintext = Crypt::decryptString($m->body_encrypted);
            } catch (\Exception $e) {
                $plaintext = '[cannot-decrypt]';
            }
            return [
                'id' => $m->id,
                'from' => $m->sender_id,
                'to' => $m->recipient_id,
                'body' => $plaintext,
                'read' => (bool) $m->read,
                'created_at' => $m->created_at->toDateTimeString(),
            ];
        });

        // Optionally mark unread messages as read when requested by recipient
        if ($request->query('mark_read') === '1') {
            Message::where('recipient_id', $userId)
                ->where('sender_id', $partnerId)
                ->where('read', false)
                ->update(['read' => true]);
        }

        return response()->json([
            'partner_id' => $partnerId,
            'messages' => $payload,
        ]);
    }

    // Helper: canonical conversation key for pair - deterministic and order-insensitive
    protected function conversationKey($a, $b)
    {
        $ids = [$a, $b];
        sort($ids, SORT_NUMERIC);
        return $ids[0] . '_' . $ids[1];
    }

    
    protected function areMatched($a, $b)
    {
        
        return true;
    }
}
