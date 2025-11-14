<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeMatchController extends Controller
{
    
    public function getMatches($traderId)
    {
        // Get trader info
        $trader = DB::table('traders')->where('id', $traderId)->first();
        if (!$trader) {
            return response()->json(['error' => 'Trader not found'], 404);
        }

        //  Get trader’s offers
        $offers = DB::table('offers')->where('trader_id', $traderId)->get();

        //  Get all other traders’ requests
        $requests = DB::table('requests')
            ->join('traders', 'traders.id', '=', 'requests.trader_id')
            ->select('requests.*', 'traders.city', 'traders.trust_score')
            ->where('requests.trader_id', '!=', $traderId)
            ->get();

        $matches = [];

        // Compare offers and requests
        foreach ($offers as $offer) {
            foreach ($requests as $req) {
                $score = 0;

                // Basic similarity check (AI-like rule)
                similar_text(strtolower($offer->title), strtolower($req->title), $titleScore);
                similar_text(strtolower($offer->category), strtolower($req->category), $catScore);

                // City match bonus
                $locationScore = ($trader->city === $req->city) ? 20 : 0;

                // Trust score influence
                $trustScore = ($req->trust_score / 100) * 15;

                // Final weighted score
                $score = ($titleScore * 0.4) + ($catScore * 0.4) + $locationScore + $trustScore;

                if ($score > 50) {
                    $matches[] = [
                        'offer_id' => $offer->id,
                        'offer_title' => $offer->title,
                        'matched_trader_id' => $req->trader_id,
                        'requested_title' => $req->title,
                        'city' => $req->city,
                        'similarity_score' => round($score, 2),
                    ];
                }
            }
        }

        // Sort by similarity
        usort($matches, fn($a, $b) => $b['similarity_score'] <=> $a['similarity_score']);

        // Return as JSON
        return response()->json([
            'trader_id' => $traderId,
            'total_matches' => count($matches),
            'matches' => $matches,
        ]);
    }
}

