<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoPartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_partido', function (Blueprint $table) {
            $table->unsignedBigInteger('equipo_id');
            $table->unsignedBigInteger('partido_id');
            $table->boolean('es_local');
            $table->tinyInteger('cantidad_goles');

            $table->primary(['equipo_id','partido_id']);

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('partido_id')->references('id')->on('partidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_partido');
    }
}
