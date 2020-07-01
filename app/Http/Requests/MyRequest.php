<?php

namespace App\Http\Requests;
use Session;

use Illuminate\Foundation\Http\FormRequest;

class MyRequest extends FormRequest
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
        Session::flash('warning','Vérifiez vos champs ');
        return [
            'titre'=>'required',
            'description'=>'required',
            'fichier' => 'required|mimes:jpeg,jpg,png,pdf,docs'
        
        ];
    }
    public function messages(){
        return [
            'titre.required'=>'le champ titre est obligatoire',
            'description.required'=>'le champ description est obligatoire ',
            'fichier.required'=>'le champ fichier est obligatoire ',
            'fichier.mimes'=>'le champ fichier est obligatoire avec une extension valide'
        ];
      }

}
