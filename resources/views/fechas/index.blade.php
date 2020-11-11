@extends('layouts/master')


@section('hojas-estilo')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
@endsection

@section('contenido-principal')
<div class="row">
    <div class="col">
        <h3>Fechas</h3>
    </div>
</div>

<div class="row">
    <!--formulario-->
    <div class="col-12 col-lg-4 order-lg-1">
        <div class="card">
            <div class="card-header">
                Agregar Fecha
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('fechas.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="numero">Número Fecha:</label>
                        <input type="number" id="numero" name="numero" min="1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inicio">Inicio:</label>
                        <input type="date" id="inicio" name="inicio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="termino">Término:</label>
                        <input type="date" id="termino" name="termino" class="form-control">
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
                    <th>Fecha</th>
                    <th>Inicio</th>
                    <th>Término</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>

            @foreach ($fechas as $num=>$fecha)
            <tr>
                <td>{{$num+1}}</td>
                <td>Fecha {{$fecha->numero}}</td>
                <td>{{date('d-m-Y',strtotime($fecha->inicio))}}</td>
                <td>{{date('d-m-Y',strtotime($fecha->termino))}}</td>
                <td class="text-center" style="width:1rem">
                    <!--Borrar-->
                    <span data-toggle="tooltip" data-placement="top" title="Borrar Fecha">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#fechaBorrarModal{{$fecha->id}}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </span>
                    <!--/Borrar-->
                </td>
                <td class="text-center" style="width:1rem">
                    <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                        title="Editar Fecha">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td class="text-center" style="width:1rem">
                    <a href="{{route('fechas.show',$fecha->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                        title="Ver Jugadores">
                        <i class="fas fa-user-friends"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal Borrar Fecha -->
            <div class="modal fade" id="fechaBorrarModal{{$fecha->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Borrar Fecha</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle text-danger mr-2" style="font-size: 2rem"></i>
                                ¿Desea borrar al fecha {{$fecha->nombre}}?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="{{route('fechas.destroy',$fecha->id)}}">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Borrar Fecha</button>
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