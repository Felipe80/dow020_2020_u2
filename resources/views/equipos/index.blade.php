@extends('layouts/master')


@section('hojas-estilo')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
@endsection

@section('contenido-principal')
<div class="row">
    <div class="col">
        <h3>Equipos</h3>
    </div>
</div>

<div class="row">
    <!--formulario-->
    <div class="col-12 col-lg-4 order-lg-1">
        <div class="card">
            <div class="card-header">
                Agregar Equipo
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('equipos.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre Equipo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="entrenador">Entrenador:</label>
                        <input type="text" id="entrenador" name="entrenador" class="form-control">
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
    <!--/formulario-->

    <!--tabla-->
    <div class="col-12 col-lg-8 mt-1 mt-lg-0">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Equipo</th>
                    <th class="d-none d-lg-table-cell">Entrenador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            @foreach ($equipos as $num=>$equipo)
            <tr>
                <td>{{$num+1}}</td>
                <td>
                    {{$equipo->nombre}}
                    <div class="d-lg-none">
                        <small>{{$equipo->entrenador}}</small>
                    </div>
                </td>
                <td class="d-none d-lg-table-cell">{{$equipo->entrenador}}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                        title="Borrar Equipo">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                    title="Editar Equipo">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                    title="Ver Jugadores">
                        <i class="fas fa-user-friends"></i>
                    </a>
                </td>
            </tr> 
            @endforeach
        </table>
    </div>
    <!--/tabla-->
  
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
            

        