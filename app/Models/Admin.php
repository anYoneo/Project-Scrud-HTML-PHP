<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    protected $fillable = ['name', 'username', 'password'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Hash password automatically on set.
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
