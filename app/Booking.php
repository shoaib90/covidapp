<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const BOOKING_PENDING = 0;
    const BOOKING_ACCEPTED = 1;
    const BOOKING_DECLINED = 2;

    protected $fillable = [
        'user_id','name','father_name','address','city','state', 'country','pin_code','booking_date','booking_status','booking_time_slot'
    ];

    public function bookingProvider()
    {
        return $this->hasOne('App\BookingProvider', 'booking_id', 'id');
    }

    public function report()
    {
        return $this->hasOne('App\Report'); 
    }
}
