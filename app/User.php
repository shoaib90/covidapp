<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const TYPES = [
        0 => 'Super Admin',
        1 => 'Customer',
        2 => 'Provider'
    ];
    const SUPER_ADMIN = 0;
    const CUSTOMER = 1;
    const PROVIDER = 2;

    const TOKEN_PREFIX = 'DOT0000';

    const USER_PERMISSION = [
        self::SUPER_ADMIN => [

        ],
        self::CUSTOMER => [
            'home',
            'add-booking',
            'bookings'
        ],
        self::PROVIDER => [
            'home',
            'bookings',
            'get-states',
            'accept-booking',
            'reject-booking',
            'upload-report',
            'get-pending-bookings',
            'get-booking-history'
        ]
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email','token','type','phone_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
