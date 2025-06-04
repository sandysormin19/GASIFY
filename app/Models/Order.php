<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'order_number',
        'qty_3kg',
        'qty_12kg',
        'phone_number',
        'address',
        'user_id',
        'total_price',
        'created_at',
        'courier_id',
        'courier_location', // tambahkan ini supaya bisa mass assign kalau perlu
        'delivery_lat',
        'delivery_lng',
        'payment_status',

    ];

    protected $casts = [
        'courier_location' => 'array',  // ini penting supaya Laravel tahu ini tipe array
    ];
}
