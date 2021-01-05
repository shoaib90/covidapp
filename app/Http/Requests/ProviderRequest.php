<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=> ['required', 'string', 'min:8'],
            'address' => 'required',
            'clinic_name'=>'required',
            'country' => 'required',
            'state'=> 'required',
            'city'=> 'required'
        ];
    }
}
