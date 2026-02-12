<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Method 1
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Method 2
    public function getJWTCustomClaims()
    {
        return [];
    }
}