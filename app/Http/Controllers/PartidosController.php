<?php

namespace App\Http\Controllers;

use App\Models\{Partido,Fecha,Estadio,Equipo};
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fechas = Fecha::orderBy('numero')->get();
        $estadios = Estadio::orderBy('nombre')->get();
        $equipos = Equipo::orderBy('nombre')->get();
        $partidos = Partido::orderBy('fecha_id')->orderBy('dia_hora')->get();
        return view('partidos.index',compact('fechas','estadios','equipos','partidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partido = new Partido();
        $partido->dia_hora = $request->dia.' '.$request->hora;
        $partido->estado = 0;
        $partido->fecha_id = $request->fecha;
        $partido->estadio_codigo = $request->estadio;
        $partido->save();

        $partido->equipos()->attach($request->local,['es_local'=>true,'cantidad_goles'=>0]);
        $partido->equipos()->attach($request->visita,['es_local'=>false,'cantidad_goles'=>0]);

        return redirect()->route('partidos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function show(Partido $partido)
    {
        $equipo_local = $partido->equipos()->wherePivot('es_local',true)->get()->first();
        $equipo_visita = $partido->equipos()->wherePivot('es_local',false)->get()->first();
        return view('partidos.show',compact('partido','equipo_local','equipo_visita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function edit(Partido $partido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partido $partido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partido $partido)
    {
        $partido->equipos()->detach();
        $partido->delete();
        return redirect()->route('partidos.index');
    }

    public function goles(Partido $partido,Request $request){
        //dd($partido->id.' GL:'.$request->goles_local.' GV:'.$request->goles_visita);
        $equipo_local = $partido->equipos()->wherePivot('es_local',true)->get()->first();
        $equipo_visita = $partido->equipos()->wherePivot('es_local',false)->get()->first();
        $partido->equipos()->updateExistingPivot($equipo_local->id,['cantidad_goles'=>$request->goles_local]);
        $partido->equipos()->updateExistingPivot($equipo_visita->id,['cantidad_goles'=>$request->goles_visita]);
        return redirect()->route('partidos.show',$partido->id);
    }
}
