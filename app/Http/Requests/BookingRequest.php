<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'father_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'country'=> 'required',
            'state'=> 'required',
            'city'=> 'required',
            'provider'=>'required',
            'booking_date'=>'required'
        ];
    }
}
