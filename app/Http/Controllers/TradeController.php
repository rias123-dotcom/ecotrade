<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade;
use App\Models\item;

use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        // $trades = $user->trades()->latest()->get();
        // , compact('trades', 'user')
        return view('dashboard', compact('user'));
    }

    public function create() { return view('trades.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
        ]);

        $trade = Trade::create(array_merge($data, ['user_id' => Auth::id()]));
        return redirect()->route('dashboard')->with('success', 'Trade created');
    }

    public function index()
    {
        $trades = Trade::latest()->paginate(20);
        return view('trades.index', compact('trades'));
    }
     public function item(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Item,Service,Skill',
            'quantity' => 'nullable|string|max:100',
            'seeking' => 'nullable|string|max:255',
            'value' => 'required|numeric',
            'image_url' => 'nullable|string|max:500',
        ]);

        $trade = new item();
        $trade->trader_id = Auth::id();
        $trade->title = $request->title;
        $trade->description = $request->description;
        $trade->category = $request->category;
        $trade->quantity = $request->quantity;
        $trade->seeking = $request->seeking;
        $trade->value = $request->value;
        $trade->status = 'Active';
        $trade->image_url = $request->image_url;
        $trade->is_user_post = true;
        $trade->offers = 0;
        $trade->location = Auth::user()->location ?? null;
        $trade->save();

        return redirect()->route('trades.dashboard')->with('success', 'Trade created successfully.');
    }

}
