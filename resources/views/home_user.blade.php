@extends('layouts.app_user')

@section('content')
<section class="home-section home-1 home-home">
    <div class="container">
                @foreach($folders as $folder)
                <div class="row" id="show_row_{{ $folder->id }}">
                    <div class="col-12">
                        <h2>{{ $folder->name }}</h2>
                        @if($folder->id === 1 || $folder->id === 3)
                            <a href="#" id="showAll_{{ $folder->id }}" class="all_show">Ver todo</a>
                        @endif
                        @php
                            $folder_childs = getFolders($folder->id)
                        @endphp
                    </div>
                        @foreach($folder_childs as $folder_child )
                            <div class="col-md-4">
                                <a href="{{url('/categoria')}}/{{ $folder_child->slug }}" class="" id="" base="">
                                    <div class="content-registro" style="background-image: url({{ url('archivos') }}/{{ $folder_child->image }});"></div>
                                    <p class="text-center">
                                       {{ $folder_child->name }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                </div>
                @endforeach
    </div>
</section>

<section class="registro-section hide">
    <a href="" class="close"><i class="fas fa-times"></i></a>
    @isset($registros)
        <img class="image_registro" src="{{ url('img/registros') }}/{{$registros[0]->imagen}}" alt="">
        <h3 class="title"><span>{{$registros[0]->nombre}}</span></h3><a href="">Cambiar nombre <i class="fa-solid fa-pen-to-square"></i></a>
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
        <h3 class="title"><span></span></h3><a href="">Cambiar nombre <i class="fa-solid fa-pen-to-square"></i></a>
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
