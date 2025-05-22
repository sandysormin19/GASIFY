<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Stock extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'stocks';

    protected $fillable = ['type', 'quantity'];

    public $timestamps = false;
}
