@extends('layouts.master')

@section('hojas-estilo')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
@endsection

@section('contenido-principal')
    <h3>Estadios</h3>
    <hr>

    <div class="row mb-2">
        <div class="col"><a href="{{route('estadios.create')}}" class="btn btn-info">Agregar Estadio</a></div>
    </div>

    <div class="row">
        @foreach ($estadios as $estadio)
        <div class="col-12 col-md-4 col-lg-3 mb-2">
            <div class="card">
                <img src="{{Storage::url($estadio->imagen)}}" alt="{{$estadio->nombre}}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{$estadio->nombre}}</h5>
                    <p>{{$estadio->ciudad}}</p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-2 mb-md-0">
                            <a href="#" class="btn btn-danger btn-block">
                                <i class="far fa-trash-alt"></i>
                                Borrar
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="#" class="btn btn-warning btn-block">
                                <i class="far fa-edit"></i>
                                Editar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach      
    </div>
@endsection