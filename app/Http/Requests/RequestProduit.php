<?php

namespace App\Http\Requests;
use Session;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        Session::flash('warning','Vérifiez vos champs ');
        return [
            'Name'=>'required',
            'Description'=>'required',
            'DD'=>'required',
            'DF'=>'required',
            'HD'=>'required',
            'HF'=>'required',
            'Qte'=>'required',
            'Prix'=>'required',
            'Prixini'=>'required',
            'tyype'=>'required'
            
        
        ];
    }
    public function messages(){
        return [
            'Name.required'=>'Ce champ est obligatoire ',
            'Description.required'=>'Ce champ est obligatoire ',
            'DD.required'=>'Ce champ est obligatoire ',
            'DF.required'=>'Ce champ est obligatoire ',
            'HD.required'=>'Ce champ est obligatoire ',
            'HF.required'=>'Ce champ est obligatoire ',
            'Qte.required'=>'Ce champ est obligatoire ',
            'Prix.required'=>'Ce champ est obligatoire ',
            'Prixini.required'=>'Ce champ est obligatoire ',
            'tyype.required'=>'Ce champ est obligatoire '
        ];
      }
}
