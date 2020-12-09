@extends('layouts/master')


@section('hojas-estilo')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
@endsection

@section('contenido-principal')
<div class="row">
    <div class="col">
        <h3>Jugadores</h3>
    </div>
</div>

<div class="row">
    <!--formulario-->
    <div class="col-12 col-lg-4 order-lg-1">
        <div class="card">
            <div class="card-header">
                Agregar Jugador
            </div>
            <div class="card-body">
                <!--validacion-->
                @if ($errors->any())
                <div class="alert alert-warning">
                    <p>Por favor solucione los siguiente problemas:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!--/validacion-->
                <form method="POST" action="{{route('jugadores.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="rut">Rut:</label>
                        <input type="text" id="rut" name="rut" class="form-control @error('rut') is-invalid @enderror" value="{{old('rut')}}">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{old('apellido')}}">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="posicion">Posición:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pos-arquero" name="posicion" value="Arquero" checked>
                                <label class="form-check-label" for="pos-arquero">Arquero</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pos-defensa" name="posicion" value="Defensa">
                                <label class="form-check-label" for="pos-defensa">Defensa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pos-volante" name="posicion" value="Volante">
                                <label class="form-check-label" for="pos-volante">Volante</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pos-delantero" name="posicion" value="Delantero">
                                <label class="form-check-label" for="pos-delantero">Delantero</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número Camiseta:</label>
                        <input type="number" id="numero" name="numero" class="form-control" min="1" max="99">
                    </div>
                    <div class="form-group">
                        <label for="equipo">Equipo:</label>
                        <select class="form-control" id="equipo" name="equipo">
                            @foreach ($equipos as $equipo)
                            <option value="{{$equipo->id}}">{{$equipo->nombre}}</option>
                            @endforeach                          
                        </select>
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
    <!--/formulario-->

    <!--tabla-->
    <div class="col-12 col-lg-8 mt-1 mt-lg-0">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th class="d-lg-none">Jugador</th>
                    <th class="d-none d-lg-table-cell">Apellido</th>
                    <th class="d-none d-lg-table-cell">Nombre</th>
                    <th class="d-none d-lg-table-cell">Posición</th>
                    <th class="d-none d-lg-table-cell">Número</th>
                    <th class="d-none d-lg-table-cell">Equipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            @foreach ($jugadores as $num=>$jugador)
            <tr>
                <td>{{$num+1}}</td>
                <td class="d-lg-none">
                    {{$jugador->nombre}} {{$jugador->apellido}} ({{$jugador->numero}})<br>
                    {{$jugador->posicion}}, {{$jugador->equipo!=null?$jugador->equipo->nombre:'Sin equipo'}}
                </td>
                <td class="d-none d-lg-table-cell">{{$jugador->apellido}}</td>
                <td class="d-none d-lg-table-cell">{{$jugador->nombre}}</td>
                <td class="d-none d-lg-table-cell">{{$jugador->posicion}}</td>
                <td class="d-none d-lg-table-cell">{{$jugador->numero}}</td>
                <td class="d-none d-lg-table-cell">
                    {{$jugador->equipo!=null?$jugador->equipo->nombre:'Sin equipo'}}
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                        title="Borrar Jugador">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="{{route('jugadores.edit',$jugador->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                    title="Editar Jugador">
                        <i class="far fa-edit"></i>
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
            

        