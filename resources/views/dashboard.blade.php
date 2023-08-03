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
    <title>{{ Auth::user()->sucursal }} | Administrador</title>
  </head>
  
  <body class="body-admin">
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img src="{{ url('img/logo-SOC.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-12" style="margin-top: -24px; margin-bottom: 5%">
                    <h1 class="text-center">Bienvenido {{ Auth::user()->sucursal }}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <form method="POST" action="{{ route('update') }}" enctype='multipart/form-data'>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="alert alert-info" role="alert">
                        <strong>Link de tu Micrositio:</strong> <a href="{{url('broker')}}/{{$registro->url}}">{{url('broker')}}/{{$registro->url}}</a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h3 class="text-center">Logo</h3>
                        </div>
                        <div class="col-12">
                            <p class="text-center">Da clic en el logo de SOC para poder adjuntar el logo de tu oficina</p>
                        </div>
                        <div class="col-md-4 col-12">
                        <input type="file" class="form-control" name="logo" id="logo" hidden>
                        <label for="logo">
                            @if ($registro->logo != null)
                                <img src="{{url('img/brokers')}}/{{$registro->logo}}" alt="" class="ml-2 dashboard-img">
                            @else
                                <img src="{{url('img/logo-SOC.jpg')}}" alt="" class="ml-2 dashboard-img">  
                            @endif
                        </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-12 mb-4 mt-4">
                            <h3>Productos Hipotecarios</h3>
                        </div>
                        <div class="col-12">
                            <p class="text-center">Selecciona las opciones que quieras mostrar en tu micrositio</p>
                        </div>
                        <div class="col-md-4 col-12 mb-4">
                            @csrf
                            @if ($registro->producto_2 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_2" checked  value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Adquisición de vivienda" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_2" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Adquisición de vivienda" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_3 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_3" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Construcción" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_3" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Construcción" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_4 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_4" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Cambio de hipoteca" checked readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_4" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Cambio de hipoteca" readonly=»readonly»>
                                </div>
                            @endif
                            
                            @if ($registro->producto_5 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_5" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Adquisición de terreno" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_5" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Adquisición de terreno" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_6 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_6" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Terreno + Construcción" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_6" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Terreno + Construcción" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_7 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_7" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Preventa" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_7" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Preventa" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_8 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_8" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Liquidez" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_8" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Liquidez" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_9 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_9" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Liquidez + sustitución" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_9" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Liquidez + sustitución" readonly=»readonly»>
                                </div>
                            @endif
    
                            @if ($registro->producto_10 == "1")
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_10" checked value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Renovación / Remodelación" readonly=»readonly»>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="producto_10" value="1">
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" value="Renovación / Remodelación" readonly=»readonly»>
                                </div>
                            @endif
                    
                        </div>
                    </div>
                </div>
                    <div class="col-12 mt-4 mb-4">
                        <h3 class="text-center">Imágenes de instalaciones</h3>
                        <p class="text-center">A continuación, se muestran una serie de imágenes propuestas para mostrar las instalaciones de SOC.</p>
                        <p class="text-center">Es posible reemplazarlas por imágenes propia, da clic en la imagen que quieres cambiar y adjunta la que deseas mostrar.</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="oficina_1" id="oficina_1" hidden>
                                        <label for="oficina_1">
                                            @if ($registro->oficina_1 != null)
                                                <img src="{{url('img/oficinas')}}/{{$registro->oficina_1}}" alt="" class="ml-2 dashboard-img">
                                            @else
                                                <img src="{{url('img/oficina_1.jpeg')}}" alt="" class="ml-2 dashboard-img">  
                                            @endif
                                        </label>
                                    </div>
                                    <label class="ml-2">Imagen 1</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="oficina_2" id="oficina_2" hidden>
                                        <label for="oficina_2">
                                            @if ($registro->oficina_2 != null)
                                                <img src="{{url('img/oficinas')}}/{{$registro->oficina_2}}" alt="" class="ml-2 dashboard-img">
                                            @else
                                                <img src="{{url('img/oficina_2.jpeg')}}" alt="" class="ml-2 dashboard-img">  
                                            @endif
                                        </label>
                                    </div>
                                    <label class="ml-2">Imagen 2</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="oficina_3" id="oficina_3" hidden>
                                        <label for="oficina_3">
                                            @if ($registro->oficina_3 != null)
                                                <img src="{{url('img/oficinas')}}/{{$registro->oficina_3}}" alt="" class="ml-2 dashboard-img">
                                            @else
                                                <img src="{{url('img/oficina_3.jpeg')}}" alt="" class="ml-2 dashboard-img">  
                                            @endif
                                        </label>
                                    </div>
                                    <label class="ml-2">Imagen 3</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="oficina_4" id="oficina_4" hidden>
                                        <label for="oficina_4">
                                            @if ($registro->oficina_4 != null)
                                                <img src="{{url('img/oficinas')}}/{{$registro->oficina_4}}" alt="" class="ml-2 dashboard-img">
                                            @else
                                                <img src="{{url('img/oficina_4.jpeg')}}" alt="" class="ml-2 dashboard-img">  
                                            @endif
                                        </label>
                                    </div>
                                    <label class="ml-2">Imagen 4</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="oficina_5" id="oficina_5" hidden>
                                        <label for="oficina_5">
                                            @if ($registro->oficina_5 != null)
                                                <img src="{{url('img/oficinas')}}/{{$registro->oficina_5}}" alt="" class="ml-2 dashboard-img">
                                            @else
                                                <img src="{{url('img/oficina_5.jpeg')}}" alt="" class="ml-2 dashboard-img">  
                                            @endif
                                        </label>
                                    </div>
                                    <label class="ml-2">Imagen 5</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="oficina_6" id="oficina_6" hidden>
                                        <label for="oficina_6">
                                            @if ($registro->oficina_6 != null)
                                                <img src="{{url('img/oficinas')}}/{{$registro->oficina_6}}" alt="" class="ml-2 dashboard-img">
                                            @else
                                                <img src="{{url('img/oficina_6.jpeg')}}" alt="" class="ml-2 dashboard-img">  
                                            @endif
                                        </label>
                                    </div>
                                    <label class="ml-2">Imagen 6</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h3 class="text-center">Contacto</h3>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" :value="__('Sucursal')">Nombe de Sucursal</label>
                                    <input id="name" class="form-control" type="text" name="sucursal" value="{{$registro->sucursal}}" :value="old('sucursal')" required >
                                </div>
                                <div class="form-group">
                                    <label for="name" :value="__('Teléfono')">Teléfono</label>
                                    <input id="name" class="form-control" type="text" name="telefono" value="{{$registro->telefono}}" :value="old('telefono')" required >
                                </div>
                                <div class="form-group">
                                    <label for="name" :value="__('Horario')">Horario</label>
                                    <textarea class="form-control" name="horario" id="" cols="30" rows="3" :value="old('horario')" required >{{$registro->horario}}</textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="name" :value="__('Dirección')">Dirección</label>
                                    <input type="text" name="direccion" value="{{$registro->direccion}}" required class="form-control">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="name" :value="__('url_mapa')">Mapa</label>
                                    <input type="text" name="url_mapa" value="{{$registro->url_mapa}}" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group d-flex align-items-center">
                                    <img src="{{ url('img/001-facebook.png') }}" alt="" width="30px">
                                    <input type="text" name="facebook" class="ml-2 form-control" placeholder="Url Facebook" value="{{$registro->facebook}}">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <img src="{{ url('img/004-twitter.png') }}" alt="" width="30px">
                                    <input type="text" name="twitter" class="ml-2 form-control" placeholder="Url Twitter" value="{{$registro->twitter}}">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <img src="{{ url('img/005-youtube.png') }}" alt="" width="30px">
                                    <input type="text" name="youtube" class="ml-2 form-control" placeholder="Url Youtube" value="{{$registro->youtube}}">
                                </div>
                            
                                <div class="form-group d-flex align-items-center">
                                    <img src="{{ url('img/002-linkedin.png') }}" alt="" width="30px">
                                    <input type="text" name="linkedin" class="ml-2 form-control" placeholder="Url Linkedin" value="{{$registro->linkedin}}">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <img src="{{ url('img/003-instagram.png') }}" alt="" width="30px">
                                    <input type="text" name="instagram" class="ml-2 form-control" placeholder="Url Instagram" value="{{$registro->instagram}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-success">
                                        {{ __('Guardar') }}
                                    </button><br>
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