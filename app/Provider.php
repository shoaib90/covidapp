<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'user_id','clinic_name','address','city','state', 'country','pin_code'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
