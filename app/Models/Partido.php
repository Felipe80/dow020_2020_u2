<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    protected $table = 'partidos';
    public $timestamps = false;

    public function fecha(){
        return $this->belongsTo('App\Models\Fecha');
    }

    public function estadio(){
        return $this->belongsTo('App\Models\Estadio','estadio_codigo','codigo');
    }

    public function equipos(){
        return $this->belongsToMany('App\Models\Equipo')->withPivot('cantidad_goles');
    }

    public function equipoLocal($local){
        return $this->belongsToMany('App\Models\Equipo')->wherePivot('es_local',$local);
    }
}
