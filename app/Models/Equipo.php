<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'equipos';

    public function jugadores(){
        return $this->hasMany('App\Models\Jugador');
    }

    public function partidos(){
        return $this->belongsToMany('App\Models\Partido')->withPivot(['es_local','cantidad_goles']);
    }

    /*
    * Recibe un objeto partido e indica si el equipo ganó, empató o perdió
    */
    private function getResultadoPartido(Partido $partido){
        $goles_equipo = $partido->equipos()->where('equipo_id',$this->id)->first()->pivot->cantidad_goles;
        $goles_rival = $partido->equipos()->where('equipo_id','!=',$this->id)->first()->pivot->cantidad_goles;

        return $goles_equipo>$goles_rival?'G':($goles_equipo==$goles_rival?'E':'P');
    }

    private function getPartidos($tipo){
        return $this->partidos->filter(function($partido) use ($tipo){
            if($this->getResultadoPartido($partido)==$tipo){
                return $partido;
            }
        });
    }

    public function getPuntos(){
        return $this->getPG()->count()*3+$this->getPE()->count();
    }

    public function getPG(){
        return $this->getPartidos('G');
    }

    public function getPE(){
        return $this->getPartidos('E');
    }

    public function getPP(){
        return $this->getPartidos('P');
    }

    public function getGF(){
        return $this->partidos->sum('pivot.cantidad_goles');
    }

    public function getGC(){
        $goles_rival = 0;
        // foreach($this->partidos as $partido){
        //     $goles_rival += $partido->equipos()->wherePivot('equipo_id','!=',$this->id)->first()->pivot->cantidad_goles;
        // }

        $this->partidos->each(function($partido) use(&$goles_rival){
            $goles_rival += $partido->equipos()->wherePivot('equipo_id','!=',$this->id)->first()->pivot->cantidad_goles;
        });

        return $goles_rival;
    }
}
