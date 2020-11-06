@extends('layouts.master')

@section('contenido-principal')
    <h3>Agregar Estadio</h3>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Agregar Estadio
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('estadios.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="codigo">Código:</label>
                            <input type="text" id="codigo" name="codigo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre Estadio:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" id="ciudad" name="ciudad" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" id="imagen" name="imagen" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-lg-3 offset-lg-6 pr-lg-0">
                                    <button type="reset" class="btn btn-warning btn-block">Cancelar</button>
                                </div>
                                <div class="col-12 col-lg-3 mt-1 mt-lg-0">
                                    <button type="submit" class="btn btn-info btn-block">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection