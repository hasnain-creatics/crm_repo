<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed|min:8',
            // 'password_confirmation' => 'required|min:8',
            'designation' => 'required',    
            'phone_number' => 'required',   
            'alternate_phone_number' => 'required', 
            'salary' => 'required'
        ];
    }

     public function messages()
    {
        return [
            'email.requiered'   => 'Email is required!',
            'password.required' => 'Password is required!',     
            // 'first_name.required' => 'First Name Required!',
            'last_name.required' => 'Last Name Required!',
            'password.required' => 'Password Required!',
            'designation.required' => 'Designation Required!',
            'phone_number.required' => 'Phone No Required!',
            'alternate_phone_number.required' => 'Alternate Phone Required!',
            'salary.required' => 'Salary Required!'
        ];
    }
}
