<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquiposController extends Controller
{
    public function index(){
        $equipos = Equipo::all();
        return view('equipos.index',compact('equipos'));
    }

    public function store(Request $request){
        $equipo = new Equipo();
        $equipo->nombre = $request->nombre;
        $equipo->entrenador = $request->entrenador;
        $equipo->save();
        return redirect()->route('equipos.index');
    }
}
