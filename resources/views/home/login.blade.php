<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Campeonato de Fútbol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body style="background: linear-gradient(to bottom, #026597 0%, #990099 120%);">
    <div class="container-fluid vh-100 d-flex flex-column justify-content-lg-center">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="row bg-light shadow-lg" style="height: 25rem;">
                    <!--titulo y logo-->
                        <div class="col-lg-4 bg-primary d-flex flex-column justify-content-center align-items-center text-center pt-3">
                            <div class="bg-white p-2 mb-3 rounded">
                                <img src="{{ asset('images/isotipo_usm.jpg') }}">
                            </div>
                            <h4 class="text-light">Sistema de Campeonato de Fútbol</h4>
                            <h6 class="text-light">DOW020 - Diseño y Programación Orientada a la Web</h6>
                        </div>
                    <!--/titulo y logo-->

                    <!--formulario-->
                        <div class="col-lg-8 bg-white d-flex flex-column justify-content-center py-3">
                            <h4>Inicio de Sesión</h4>
                            <small>Proporcione sus credenciales para ingresar al sistema</small>
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="username">Nombre de Usuario:</label>
                                            <input type="text" id="username" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Contraseña:</label>
                                            <input type="password" id="password" class="form-control">
                                        </div>
                                        <div class="text-right">
                                            <div class="row">
                                                <div class="col col-lg-3 offset-lg-9">
                                                    <a href="{{route('home.index')}}" class="btn btn-success btn-block">Iniciar Sesión</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!--/formulario-->
                </div>
            </div>
        </div>
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
</body>
</html>