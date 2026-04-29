<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'name', 'last_name', 'email', 'password',
        'phone_number', 'address', 'city', 'state', 'position'
    ];

    protected $hidden = ['password'];
}
