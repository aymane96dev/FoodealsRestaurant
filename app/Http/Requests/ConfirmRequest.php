<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;
class ConfirmRequest extends FormRequest
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
      'password'=>'required|min:8',
      'Confirmation'=>'required|same:password'
      // 'Latitude'=>'required|regex:/^[+-]?[0-9]{1,9}(?:\.[0-9]{1,10})?$/',
      // 'Longitude'=>'required|regex:/^[+-]?[0-9]{1,9}(?:\.[0-9]{1,10})?$/', 
        ];
    }
    public function messages()
    {
        return [
      'password'=>'required',    
      'Confirmation.required'=>'le champ fichier est obligatoire',
      // 'Latitude.regex'=>'This field must be double',
      // 'Longitude.regex'=>'This field must be double', 
    ];
    }
}
