<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Campeonato de Fútbol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">   
    @yield('hojas-estilo')
</head>

<body>
    <div class="container-fluid p-0">
        <!--usuario-->
        <div class="row text-white m-0" style="background-color: #222;">
            <div class="col-8">
                Bienvenido <b>User1</b>
            </div>
            <div class="col-3 text-right d-none d-lg-block">
                <small>Último inicio de sesión: 06/10/2020 a las 22:28</small>
            </div>
            <div class="col-1 text-right d-none d-lg-block">
                <a href="{{route('home.login')}}" class="text-white">Cerrar Sesión</a>
            </div>
        </div>
        <!--/usuario-->

        <!--navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">DOW020</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(Route::current()->getName()=='home.index') active @endif">
                        <a class="nav-link" href="{{route('home.index')}}">Inicio</a>
                    </li>
                    <li class="nav-item @if(Request::segments()[0]=='equipos') active @endif">
                        <a class="nav-link" href="{{route('equipos.index')}}">Equipos</a>
                    </li>
                    <li class="nav-item @if(Request::segments()[0]=='estadios') active @endif">
                        <a class="nav-link" href="{{route('estadios.index')}}">Estadios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Estadísticas</a>
                    </li>
                    <li class="nav-item @if(Request::segments()[0]=='jugadores') active @endif">
                        <a class="nav-link" href="{{route('jugadores.index')}}">Jugadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Partidos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Configuración
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Cambiar Contraseña</a>
                            <a class="dropdown-item" href="#">Usuarios</a>
                            <a class="dropdown-item d-lg-none" href="index.html">Cerrar Sesión</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://www.usm.cl" target="_blank">UTFSM</a>
                        </div>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </nav>
        <!--/navbar-->

        <!--contenido-->
        <div class="p-2">
            @yield('contenido-principal')
        </div>
        <!--/contenido-->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    @yield('scripts')
</body>

</html>