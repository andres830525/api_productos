<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductosRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|string',
            'precio' => 'required|numeric',
        ];
        
    }

    public function messages()

    {

        return [

           ' titulo.required' => 'Title is required',

            'descripcion.required' => 'Body is required',

        ];

    }

}
