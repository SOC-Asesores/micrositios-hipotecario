<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('css/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <title>Micrositios | SOC Asesores</title>
  </head>
  <body class="body-admin">
    <header></header>
    <main>
        <div class="container">
            <form method="POST" action="{{ route('register') }}">
            <div class="row justify-content-center">
                <div class="col-12">
                  <h1 class="text-center">Bienvenido a Micrositios SOC</h1>
                </div>
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <img src="{{ url('img/logo-SOC.jpg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                    <div class="col-md-4 col-12">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        @csrf
                        <div class="form-group">
                            <label for="name" :value="__('Name')">Nombe de Usuario</label>
                            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email" :value="__('Email')">Correo</label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email" :value="__('Email')">Password</label>
                            <input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" :value="__('Confirm Password')">Confirmar Password</label>
                            <input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_2" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Adquisición de vivienda" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_3" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Construcción" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_4" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Cambio de hipoteca" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_5" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Adquisición de terreno" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_6" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Terreno + Construcción" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_7" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Preventa" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_8" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Liquidez" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_9" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Liquidez + sustitución" readonly=»readonly»>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" name="producto_10" value="1">
                              </div>
                            </div>
                            <input type="text" class="form-control" value="Renovación / Remodelación" readonly=»readonly»>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" :value="__('Sucursal')">Nombe de Sucursal</label>
                            <input id="name" class="form-control" type="text" name="sucursal" :value="old('sucursal')" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="name" :value="__('Telefono')">Telefono</label>
                            <input id="name" class="form-control" type="text" name="telefono" :value="old('telefono')" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="name" :value="__('Horario')">Horario</label>
                            <textarea class="form-control" name="horario" id="" cols="30" rows="5" :value="old('horario')" required autofocus></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name" :value="__('Direccion')">Direccion</label>
                            <textarea class="form-control" name="direccion" id="" cols="30" rows="5" :value="old('direccion')" required autofocus></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-success">
                                        {{ __('Registrar') }}
                                    </button><br>
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Ya estas registrado?') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
        </div>
    </main>
  </body>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{url('js/slick.min.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>
  </body>
</html>