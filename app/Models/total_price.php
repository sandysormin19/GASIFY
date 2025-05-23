<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class total_price extends Model
{
    protected $fillable = [
        'user_id', 'qty_3kg', 'qty_12kg',
        'payment_method', 'address', 'total_price', 'created_at'
    ];
}
