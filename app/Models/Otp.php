<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Otp extends Authenticatable
{

    protected $table = 'otp';
    protected $fillable = [
        'name',
        'phone_number',
        'otp_number',
        'password',
        'email',
    ];

}
