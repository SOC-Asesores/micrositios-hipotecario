@extends('layouts.app')

@section('content')
<section class="home-section home-1">
    <div class="container">
            @if(!$archivos->isEmpty())
            <div class="row">
                <div class="col-12">
                    <h2 style="text-transform: capitalize;">{{$linea}}</h2>
                </div>
                @foreach ($archivos as $registro_corporativa)
                    @php
                        $imagen = explode(".", $registro_corporativa->url);
                        if ($imagen[1] == "jpg" || $imagen[1] == "png") {
                            $registro_imagen = $registro_corporativa->url;
                        }else{
                            $registro_imagen = "document.png";
                        }
                    @endphp
                    <div class="col-md-4">
                        <a href="/{{$registro_corporativa->url}}" class="archivo_id" id="{{$registro_corporativa->id}}" base="{{ url('archivos') }}/">
                            <div class="content-registro" style="background-image: url({{ url('archivos') }}/{{$registro_imagen}});"></div>
                            <p class="text-center">
                                {{$registro_corporativa->url}}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
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
        <a class="download" href="" files="{{$archivos}}" base="{{ url('archivos') }}/"><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
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
        <a class="download" href="" files="[]" base="{{ url('archivos') }}/"><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
        <div class="dropdown">
          <button class="dropbtn"><i class="fas fa-share"></i>Compartir</button>
          <div class="dropdown-content">
            <a id="linkedin" href="" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
            <a id="facebook" href="" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a id="twitter" href="" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
          </div>
        </div>
        <a class="copy" href="" ><i class="far fa-copy"></i> Copiar vínculo</a>
        <a class="delete-file" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>
    @endempty
</section>
@endsection
