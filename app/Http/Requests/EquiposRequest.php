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
            'nombre' => 'required|min:3|max:20|unique:equipos,nombre',
            'entrenador' => 'required|min:5|max:20'
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'Indique el nombre del equipo',
            'nombre.min' => 'El nombre debe tener como mínimo 3 letras',
            'nombre.max' => 'El nombre debe tener como máximo 20 letras',
            'nombre.unique' => 'Ya existe un equipo llamado :input',
            'entrenador.required' => 'Indique el entrenador',
            'entrenador.min' => 'Entrenador debe tener como mínimo 5 letras',
            'entrenador.max' => 'Entrenador debe tener como máximo 20 letras',
        ];
    }
}
