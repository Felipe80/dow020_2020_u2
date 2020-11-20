<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquiposRequest extends FormRequest
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
            'nombre' => 'required',
            'entrenador' => 'required'
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'Indique el nombre del equipo',
            'entrenador.required' => 'Indique el entrenador'
        ];
    }
}
