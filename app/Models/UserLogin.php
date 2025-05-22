<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserLogin extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'user_logins';

    protected $fillable = ['user_id', 'email',
                         'ip_address', 'logged_in_at'];
}
