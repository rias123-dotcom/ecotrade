<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trader1_id', 'trader2_id',
        'item_offered', 'item_requested',
        'estimated_value', 'status',
        'fraud_probability', 'fraud_risk',
        'trader1_score', 'trader2_score',
        'trader1_feedback', 'trader2_feedback'
    ];
}
