<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;

class Admin extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait, Notifiable;

    protected $collection = 'admins';

    protected $fillable = [
        'name', 'email', 'password',
    ];
}
