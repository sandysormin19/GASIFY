<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'qty_3kg',
        'qty_12kg',
        'payment_method',
        'address',
        'user_id',
        'total_price',
        'created_at'
    ];
}
