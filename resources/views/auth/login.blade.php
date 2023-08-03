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
    <header>
      <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="{{ url('img/logo-SOC.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                  <h1 class="text-center">Bienvenido a Micrositios SOC</h1>
                </div>
                <div class="col-md-4 col-12">
                   <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
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
                      <!-- Confirm Password -->
          
                      <div class="text-center mt-4">
                          <button class="btn btn-success">
                              {{ __('Loguear') }}
                          </button><br>
                      </div>
                  </form>
                </div>
            </div>
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