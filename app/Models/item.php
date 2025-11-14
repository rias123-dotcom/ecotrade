<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
     protected $table = 'items'; 

      protected $fillable = [
        'title',
        'description',
        'category',
        'quantity',
        'seeking',
        'value',
        'trader_id',
        'image_url',
        'status',
        'location',
        'is_user_post',
        'offers'
    ];

}
