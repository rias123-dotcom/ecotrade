<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TradeTransaction;
use Illuminate\Support\Facades\Http;

class TradeTransactionController extends Controller
{
    
    public function index()
    {
        $trades = TradeTransaction::with(['trader1', 'trader2'])->get();
        return view('trades.index', compact('trades'));
    }

    // Store new trade
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trader1_id' => 'required|integer',
            'trader2_id' => 'required|integer',
            'item_offered' => 'required|string',
            'item_requested' => 'required|string',
            'estimated_value' => 'required|numeric',
        ]);

        // Call Fraud Detection API
        $fraudResponse = Http::post(url('/api/fraud-detect'), [
            'trader_id' => $validated['trader1_id'],
            'transaction_id' => 'TX-' . uniqid(),
            'amount' => $validated['estimated_value'],
            'previous_transactions' => 5,
            'dispute_count' => 0,
            'account_age_days' => 60,
        ]);

        $fraudData = $fraudResponse->json();

        //  Save the trade transaction
        $trade = TradeTransaction::create([
            ...$validated,
            'fraud_probability' => $fraudData['fraud_probability'] ?? 0,
            'fraud_risk' => $fraudData['risk_level'] ?? 'Unknown',
            'status' => 'pending',
        ]);

        // Credit Score + Performance = Points
        $trader1_points = $this->calculateTraderPoints(80, $trade->fraud_probability, 4.5); // example
        $trader2_points = $this->calculateTraderPoints(75, $trade->fraud_probability, 4.8);

        $trade->update([
            'trader1_score' => $trader1_points,
            'trader2_score' => $trader2_points,
        ]);

        return response()->json([
            'message' => 'Trade recorded successfully!',
            'data' => $trade,
        ], 201);
    }

    
    private function calculateTraderPoints($creditScore, $fraudProbability, $feedback)
    {
        $base = $creditScore * 0.5; // credit score weight
        $feedbackPoints = $feedback * 10; // up to 50 points max
        $fraudPenalty = (1 - $fraudProbability) * 50;

        return round($base + $feedbackPoints + $fraudPenalty);
    }
}
