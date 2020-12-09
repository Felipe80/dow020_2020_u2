<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DigitoVerificadorRut;

class JugadoresRequest extends FormRequest
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
            'rut' => ['bail','required','regex:/^(\d{7,8}-[\dkK])$/',new DigitoVerificadorRut],
            'apellido' => 'required'
        ];
    }

    public function messages(){
        return [
            'rut.required' => 'Indique su RUT',
            'rut.regex' => 'Indique RUT sin puntos, con guión y con dígito verificador',
            'apellido.required' => 'Indique apellido de jugador'
        ];
    }
}
