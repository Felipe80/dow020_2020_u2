<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use PDF;

class EstadisticasController extends Controller
{
    // public function test(){
    //     $equipo = Equipo::find(15);
    //     // dd($equipo);
    //     echo 'Equipo:'.$equipo->nombre.'<hr>';
    //     echo 'PJ:'.$equipo->partidos->count().'<br>';
    //     echo 'PG:'.$equipo->getPG()->count().'<br>';
    //     echo 'PE:'.$equipo->getPE()->count().'<br>';
    //     echo 'PP:'.$equipo->getPP()->count().'<br><br>';

    //     echo 'PTS:'.$equipo->getPuntos().'<br>';
    //     echo 'GF:'.$equipo->getGF().'<br>';
    //     echo 'GC:'.$equipo->getGC().'<br>';
    // }

    private function getTabla(){
        $tablaPosiciones = collect();
        foreach(Equipo::all() as $equipo){
            $tablaPosiciones->add([
                'nombre' => $equipo->nombre,
                'PTS' => $equipo->getPuntos(),
                'PJ' => $equipo->partidos->count(),
                'PG' => $equipo->getPG()->count(),
                'PE' => $equipo->getPE()->count(),
                'PP' => $equipo->getPP()->count(),
                'GF' => $equipo->getGF(),
                'GC' => $equipo->getGC(),
                'DIF' => $equipo->getGF()-$equipo->getGC()
            ]);            
        }

        // $tablaPosiciones = $tablaPosiciones->sortByDesc('PTS');
        // $tablaPosiciones = $tablaPosiciones->sort(function($eq1,$eq2){
        //      return [$eq2['PTS'],$eq2['DIF']]<=>[$eq1['PTS'],$eq1['DIF']];
        // });
        $tablaPosiciones = $tablaPosiciones->sort(fn($eq1,$eq2) => [$eq2['PTS'],$eq2['DIF']]<=>[$eq1['PTS'],$eq1['DIF']]);
        return $tablaPosiciones->values()->all();
    }

    public function tablaPosiciones(){       
        $tablaPosiciones = $this->getTabla();
        return view('estadisticas.tabla-posiciones',compact('tablaPosiciones'));
    }

    public function descargarTablaPosiciones(){
        $tablaPosiciones = $this->getTabla();
        $pdf = PDF::loadView('estadisticas.tabla-posiciones',compact('tablaPosiciones'));
        $pdf->setPaper('letter','portrait');
        return $pdf->download('tabla-posiciones.pdf');
    }
}
