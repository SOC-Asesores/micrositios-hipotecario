@extends('layouts.app_user')

@section('content')
<section class="home-section home-1">
    <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Contenido de difusión - Seguros</h2>
                </div>
                    <!--<div class="col-md-4">
                        <a href="{{url('/')}}/categoria/C_seguros_comparador_broker" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/comparador-seguros-broker.jpg);"></div>
                            <p class="text-center">
                                Comparador de seguros - Broker
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/categoria/C_seguros_comparador_cliente" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/comparador-seguros-cliente-final.jpg);"></div>
                            <p class="text-center">
                                Comparador de seguros - Cliente final
                            </p>
                        </a>
                    </div>-->
                    <div class="col-md-4">
                        <a href="{{url('/')}}/categoria/C_seguros_mesa_del_millon" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/mesa-del-millon.jpg);"></div>
                            <p class="text-center">
                               Mesa del Millón
                            </p>
                        </a>
                    </div>
            </div>
    </div>
</section>

<section class="registro-section hide">
    <a href="" class="close"><i class="fas fa-times"></i></a>
    @isset($registros)
        <img class="image_registro" src="{{ url('img/registros') }}/{{$registros[0]->imagen}}" alt="">
        <h3 class="title">{{$registros[0]->nombre}}</h3>
        <p class="description">{{$registros[0]->descripcion}}</p>
        <p class="info"><span>{{$count}}</span> Archivos</p>
        <p class="date">Subido el: <span>{{date_format($registros[0]->created_at,"Y/m/d")}}</span></p>
        <a class="open" href="{{url('/')}}/registro/{{$registros[0]->url}}"><i class="fas fa-cloud-download-alt"></i></i> Abrir Carpeta</a>
        <div class="dropdown">
          <button class="dropbtn"><i class="fas fa-share"></i>Compartir</button>
          <div class="dropdown-content">
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$registros[0]->url}}" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{$registros[0]->url}}" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="https://twitter.com/intent/tweet?url={{$registros[0]->url}}&text=" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
          </div>
        </div>
        <a class="copy" href="{{url('/')}}/archivo/{{$registros[0]->url}}"><i class="far fa-copy"></i> Copiar vínculo</a>
        <a class="delete" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>
    @endisset

    @empty($registros)
        <img class="image_registro" src="" alt="">
        <h3 class="title"></h3>
        <p class="description"></p>
        <p class="info"><span></span> Archivos</p>
        <p class="date">Subido el: <span></span></p>
        <a class="open" href=""><i class="far fa-folder-open"></i> Abrir Carpeta</a>
        <div class="dropdown">
          <button class="dropbtn"><i class="fas fa-share"></i>Compartir</button>
          <div class="dropdown-content">
            <a id="linkedin" href="" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
            <a id="facebook" href="" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a id="twitter" href="" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
            <a id="whatsapp" href="" target="_blank"><i class="fab fa-whatsapp"></i>Whatsapp</a>
            <a id="mailto" href=""><i class="fas fa-envelope"></i>Correo</a>
          </div>
        </div>
        <a class="copy" href="hola" ><i class="far fa-copy"></i> Copiar vínculo</a>
        @if (Auth::check())
            <a class="delete" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>                 
        @else
        @endif
    @endempty
</section>
@endsection
