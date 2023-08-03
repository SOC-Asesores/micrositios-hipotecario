@extends('layouts.app_user')

@section('content')
<section class="home-section home-1">
    <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Líneas de negocio - Seguros</h2>
                </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/categoria/l_seguros_presentaciones" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/presentacion-institucional.jpg);"></div>
                            <p class="text-center">
                                Presentaciones
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/l_seguros_materiales_publicitarios_comunicacion" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/material-publicitario_seguros.jpg);"></div>
                            <p class="text-center">
                                Materiales publicitarios y de comunicación
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/categoria/l_seguros_kit_cliente_final" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/kit-bienvenida.jpg);"></div>
                            <p class="text-center">
                                Kit de bienvenida/Cliente Final
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/l_seguros_kit_bienvenida" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/kit-de-bienvenida.jpg);"></div>
                            <p class="text-center">
                                Kit de bienvenida
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/l_seguros_redes_sociales" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/redes-sociales.jpg);"></div>
                            <p class="text-center">
                                Redes Sociales
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/l_seguros_fotos_promocionales" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/fotos-promocionales.jpg);"></div>
                            <p class="text-center">
                                Galería de imágenes para diseño
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/categoria/l_seguros_videos_promocionales" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/video-promocional.jpg);"></div>
                            <p class="text-center">
                                Videos promocionales
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/')}}/categoria/l_seguros_stickers" class="" id="" base="">
                            <div class="content-registro" style="background-image: url({{ url('img') }}/stickers.jpg);"></div>
                            <p class="text-center">
                                Stickers
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
