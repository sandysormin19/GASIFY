<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class CourierLocation extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'courier_locations';

    protected $fillable = ['courier_id', 'lat', 'lng'];
}
