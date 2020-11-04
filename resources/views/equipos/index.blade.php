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
                    <th class="d-none d-lg-table-cell">Plantel</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>

            @foreach ($equipos as $num=>$equipo)
            <tr>
                <td>{{$num+1}}</td>
                <td>
                    {{$equipo->nombre}} <span class="d-lg-none">({{count($equipo->jugadores)}})</span>
                    <div class="d-lg-none">
                        <small>{{$equipo->entrenador}}</small>
                    </div>
                </td>
                <td class="d-none d-lg-table-cell">{{$equipo->entrenador}}</td>
                <td class="d-none d-lg-table-cell">{{count($equipo->jugadores)}}</td>
                <td class="text-center" style="width:1rem">
                    <!--Borrar-->
                    <span data-toggle="tooltip" data-placement="top" title="Borrar Equipo">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#equipoBorrarModal{{$equipo->id}}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </span>
                    {{-- <form method="POST" action="{{route('equipos.destroy',$equipo->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                        title="Borrar Equipo"><i class="far fa-trash-alt"></i></button>
                    </form> --}}
                    {{-- <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                        title="Borrar Equipo">
                        <i class="far fa-trash-alt"></i>
                    </a> --}}
                    <!--/Borrar-->
                </td>
                <td class="text-center" style="width:1rem">
                    <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                        title="Editar Equipo">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td class="text-center" style="width:1rem">
                    <a href="{{route('equipos.show',$equipo->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                        title="Ver Jugadores">
                        <i class="fas fa-user-friends"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal Borrar Equipo -->
            <div class="modal fade" id="equipoBorrarModal{{$equipo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Borrar Equipo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle text-danger mr-2" style="font-size: 2rem"></i>
                                ¿Desea borrar al equipo {{$equipo->nombre}}?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="{{route('equipos.destroy',$equipo->id)}}">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Borrar Equipo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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