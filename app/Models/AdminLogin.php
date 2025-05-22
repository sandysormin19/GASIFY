<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class AdminLogin extends Model
{
    protected $collection = 'admin_logins';

    protected $fillable = [
        'admin_id',
        'admin_name',
        'email',
        'ip_address',
        'login_at',
    ];

    public $timestamps = false; 
}
