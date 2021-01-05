<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public static function getAllCountries()
    {
        return Country::all()->pluck('name', 'id');
    }
    
    public static function getCountryState($countryId)
    {
        return State::where('country_id', $countryId)->pluck('name', 'id');
    }
}
