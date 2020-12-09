<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartidosRequest extends FormRequest
{
    const DIA_MAX = '2020-12-31';
    const HORA_MIN = '09:00';
    const HORA_MAX = '21:00';

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
            'dia' => 'required|date_format:Y-m-d|after_or_equal:today|before_or_equal:'.self::DIA_MAX,
            'hora' => 'required|date_format:H:i|after_or_equal:'.self::HORA_MIN.'|before_or_equal:'.self::HORA_MAX,
            'fecha' => 'required|numeric|gte:1|exists:fechas,id',
            'estadio' => 'required|exists:estadios,codigo',
            'local' => 'required|numeric|gte:1',
            'visita' => 'required|numeric|gte:1|different:local'
        ];
    }

    public function messages(){
        return [
            'dia.required' => 'Indique el día del partido',
            'dia.date_format' => 'Fecha no válida',
            'dia.after_or_equal' => 'No puede programar partidos en días que ya pasaron',
            'dia.before_or_equal' => 'Todos los partidos deben ser este año',
            'hora.required' => 'Indique la hora del partido',
            'hora.date_format' => 'Hora no válida',
            'hora.after_or_equal' => 'Los partidos deben ser entre las '.self::HORA_MIN.' hrs y las '.self::HORA_MAX.' hrs',
            'hora.before_or_equal' => 'Los partidos deben ser entre las '.self::HORA_MIN.' hrs y las '.self::HORA_MAX.' hrs',
            'fecha.required' => 'Indique fecha del campeonato',
            'fecha.numeric' => 'Fecha no válida',
            'fecha.gte' => 'Fecha no válida',
            'fecha.exists' => 'Fecha no existe',
            'estadio.required' => 'Indique estadio en que se jugará el partido',
            'estadio.exists' => 'Estadio no válido',
            'local.required' => 'Indique equipo local',
            'local.numeric' => 'Equipo local no válido',
            'local.gte' => 'Equipo local no válido',
            'visita.required' => 'Indique equipo visita',
            'visita.numeric' => 'Equipo visita no válido',
            'visita.gte' => 'Equipo visita no válido',
            'visita.different' => 'El equipo local no puede ser el mismo que el equipo visita'
        ];
    }
}
