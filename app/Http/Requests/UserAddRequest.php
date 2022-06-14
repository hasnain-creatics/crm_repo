<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UserAddRequest extends FormRequest
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
    public function rules(Request $request)
    {

            $rules['email'] = 'required|email|unique:users';
            $rules['first_name'] = 'required';
            $rules['last_name'] = 'required';
            $rules['password'] = 'required|confirmed|min:8';
            $rules['designation'] = 'required';    
            $rules['phone_number'] = 'required';   
         //   $rules['alternate_phone_number'] = 'required'; 
           // $rules['salary'] = 'required';

        if(isset($request->id)){

            $rules['email']='required|email';

            $rules['password']='confirmed';
        }

        return $rules;
        
    }

     public function messages()
    {
        // return [
        //     'email.requiered'   => 'Email is required!',
        //     'password.required' => 'Password is required!',     
        //     'first_name.required' => 'First Name Required!',
        //     'last_name.required' => 'Last Name Required!',
        //     'password.required' => 'Password Required!',
        //     'designation.required' => 'Designation Required!',
        //     'phone_number.required' => 'Phone No Required!',
        //     'alternate_phone_number.required' => 'Alternate Phone Required!',
        //     'salary.required' => 'Salary Required!'
        // ];
        
        return [
            'email.requiered'   => 'This field is required',
            'password.required' => 'This field is required',
            'first_name.required' => 'This field is required',
            'last_name.required' => 'This field is required',
            'password.required' => 'This field is required',
            'designation.required' => 'This field is required',
            'phone_number.required' => 'This field is required',
          //  'alternate_phone_number.required' => 'This field is required',
            //'salary.required' => 'This field is required',
        ];
    }
}
