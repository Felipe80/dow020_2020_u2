<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};


class Fecha extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'fechas';
    protected $fillable = ['numero','inicio','termino'];

    public function partidos(){
        return $this->hasMany('App\Models\Partido');
    }
}
