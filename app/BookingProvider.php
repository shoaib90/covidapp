<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingProvider extends Model
{
    protected $fillable = [
        'booking_id','user_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
