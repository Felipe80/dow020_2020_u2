<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{EquiposController,JugadoresController,EstadiosController,FechasController,PartidosController};
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/login',[HomeController::class,'login'])->name('home.login');

Route::get('/equipos',[EquiposController::class,'index'])->name('equipos.index');
Route::post('/equipos',[EquiposController::class,'store'])->name('equipos.store');
Route::delete('/equipos/{equipo}',[EquiposController::class,'destroy'])->name('equipos.destroy');
Route::get('/equipos/{equipo}',[EquiposController::class,'show'])->name('equipos.show');

Route::get('/jugadores',[JugadoresController::class,'index'])->name('jugadores.index');
Route::post('/jugadores',[JugadoresController::class,'store'])->name('jugadores.store');
Route::get('/jugadores/{jugador}/edit',[JugadoresController::class,'edit'])->name('jugadores.edit');
Route::put('/jugadores/{jugador}',[JugadoresController::class,'update'])->name('jugadores.update');

Route::resource('/estadios',EstadiosController::class);

Route::resource('/fechas',FechasController::class);

Route::resource('/partidos',PartidosController::class);
Route::post('/partidos/{partido}/goles',[PartidosController::class,'goles'])->name('partidos.goles');