@extends('layouts/master')


@section('hojas-estilo')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">
@endsection

@section('contenido-principal')
<div class="row">
    <div class="col">
        <h3>Partidos</h3>
    </div>
</div>

<div class="row">
    <!--formulario-->
    <div class="col-12 col-lg-4 order-lg-1">
        <div class="card">
            <div class="card-header">
                Agregar Partido
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

                <form method="POST" action="{{route('partidos.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="dia">Día:</label>
                        <input type="date" id="dia" name="dia" class="form-control @error('dia') is-invalid @enderror"
                            value="{{old('dia')}}">
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <input type="time" id="hora" name="hora"
                            class="form-control @error('hora') is-invalid @enderror" value="{{old('hora')}}">
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <select name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror">
                            <option value="seleccione">Seleccione</option>
                            @foreach ($fechas as $fecha)
                            <option value="{{$fecha->id}}">Fecha: {{$fecha->numero}}
                                ({{date('d-m-Y',strtotime($fecha->inicio))}} hasta
                                {{date('d-m-Y',strtotime($fecha->termino))}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estadio">Estadio:</label>
                        <select name="estadio" id="estadio" class="form-control @error('estadio') is-invalid @enderror">
                            @foreach ($estadios as $estadio)
                            <option value="{{$estadio->codigo}}">{{$estadio->nombre}} ({{$estadio->ciudad}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="local">Equipo Local:</label>
                        <select name="local" id="local" class="form-control @error('local') is-invalid @enderror">
                            @foreach ($equipos as $equipo)
                            <option value="{{$equipo->id}}" @if($equipo->id==old('local')) selected='selected'
                                @endif>{{$equipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visita">Equipo Visita:</label>
                        <select name="visita" id="visita" class="form-control @error('visita') is-invalid @enderror">
                            @foreach ($equipos as $equipo)
                            <option value="{{$equipo->id}}" @if($equipo->id==old('visita')) selected='selected'
                                @endif>{{$equipo->nombre}}</option>
                            @endforeach
                        </select>
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
        <table data-toggle="table" data-pagination="true" data-page-size="10" data-search="true" data-show-search-button="true" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th data-sortable="true">Nº</th>
                    <th>Equipos</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th data-sortable="true">Fecha</th>
                    <th>Resultado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($partidos as $num=>$partido)
                <tr>
                    <td>{{$num+1}}</td>
                    <td>
                        {{$partido->equipoLocal(true)->first()->nombre}} vs
                        {{$partido->equipoLocal(false)->first()->nombre}}
                    </td>
                    <td>{{date('d-m-Y',strtotime($partido->dia_hora))}}</td>
                    <td>{{date('H:i',strtotime($partido->dia_hora))}}</td>
                    <td>{{$partido->estado==0?'Pendiente':($partido->estado==1?'En curso':'Finalizado')}}</td>
                    <td>Fecha {{$partido->fecha->numero}}</td>
                    <td>
                        {{$partido->equipos()->wherePivot('es_local',true)->first()->pivot->cantidad_goles}}
                        -
                        {{$partido->equipos()->wherePivot('es_local',false)->first()->pivot->cantidad_goles}}
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <!--Borrar-->
                            <span data-toggle="tooltip" data-placement="top" title="Borrar Partido">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#partidoBorrarModal{{$partido->id}}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </span>
                            <!--/Borrar-->

                            {{-- Editar --}}
                            <a href="#" class="btn btn-sm btn-warning mx-1" data-toggle="tooltip" data-placement="top"
                                title="Editar Partido">
                                <i class="far fa-edit"></i>
                            </a>
                            {{-- /Editar --}}

                            {{-- Información --}}
                            <a href="{{route('partidos.show',$partido->id)}}" class="btn btn-sm btn-info"
                                data-toggle="tooltip" data-placement="top" title="Información Partido">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            {{-- /Información --}}
                        </div>

                        {{-- Modal Borrar Partido --}}
                        <div class="modal fade" id="partidoBorrarModal{{$partido->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Borrar Partido</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle text-danger mr-2"
                                                style="font-size: 2rem"></i>
                                            ¿Desea borrar al partido {{$partido->equipoLocal(true)->first()->nombre}} vs
                                            {{$partido->equipoLocal(false)->first()->nombre}} (Fecha
                                            {{$partido->fecha->numero}})?
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{route('partidos.destroy',$partido->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Borrar Partido</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- /Modal Borrar Partido --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--/tabla-->
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
<script src="{{asset('js/bootstrap-table-es-CL.js')}}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection