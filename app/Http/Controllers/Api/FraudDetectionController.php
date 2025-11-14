<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FraudDetectionController extends Controller
{
    public function detect(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'trader_id' => 'required|integer',
            'transaction_id' => 'required|string',
            'amount' => 'required|numeric',
            'location' => 'nullable|string',
            'previous_transactions' => 'nullable|integer',
            'dispute_count' => 'nullable|integer',
            'account_age_days' => 'nullable|integer',
            'trading_hours' => 'nullable|integer',
        ]);

        // Initialize risk score (0 = safe, 1 = risky)
        $score = 0.0;

        // Rule-based + AI-inspired logic (you can later replace with ML model)
        if ($validated['amount'] > 10000) $score += 0.25;
        if (($validated['previous_transactions'] ?? 0) < 3) $score += 0.15;
        if (($validated['dispute_count'] ?? 0) > 2) $score += 0.25;
        if (!empty($validated['location']) && strtolower($validated['location']) != 'cebu') $score += 0.15;
        if (($validated['account_age_days'] ?? 0) < 30) $score += 0.15;
        if (($validated['trading_hours'] ?? 0) > 12) $score += 0.05;

        // Clamp between 0 and 1
        $score = min(1, max(0, $score));

        // Determine risk level
        if ($score < 0.3) {
            $risk = 'Low';
        } elseif ($score < 0.6) {
            $risk = 'Medium';
        } else {
            $risk = 'High';
        }

        // Build structured JSON response
        return response()->json([
            'transaction_id' => $validated['transaction_id'],
            'fraud_probability' => round($score, 2),
            'risk_level' => $risk,
            'ai_advice' => $this->generateAdvice($risk),
            'timestamp' => now()->toDateTimeString(),
        ], 200);
    }

   
    private function generateAdvice($risk)
    {
        return match ($risk) {
            'Low' => 'This transaction appears normal. No action needed.',
            'Medium' => 'Slightly unusual activity detected. Please verify the user identity.',
            'High' => 'Potential fraud detected. Flag or suspend the transaction immediately.',
            default => 'No advice available.',
        };
    }
}
