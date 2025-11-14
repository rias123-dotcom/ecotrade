<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditScoreController extends Controller
{
    public function index()
    {
        // Sample value; you can replace this with data from your DB
        $creditScore = 74;
        return view('trader.credit_score', compact('creditScore'));
    }

    public function details()
    {
        return "Credit details page (coming soon)";
    }

    public function improve()
    {
        return "Tips to improve credit score (coming soon)";
    }
}
