@extends('layouts.app_user')

@section('content')
<section class="home-section home-1">
    <div class="container">
            @if(!$corporativa->isEmpty())
            <div class="row">
                <div class="col-12">
                    <h2>Resultados de busqueda para: {{$search}}</h2>
                </div>
                @foreach ($corporativa as $registro_corporativa)
                    @php
                        $imagen = explode(".", $registro_corporativa->imagen);
                        if ($imagen[1] == "jpg" || $imagen[1] == "png") {
                            $registro_imagen = $registro_corporativa->imagen;
                        }else if ($imagen[1] == "pdf") {
                            $registro_imagen = "/icons/pdf.png";
                        }else if ($imagen[1] == "3ds") {
                            $registro_imagen = "/icons/3ds.png";
                        }else if ($imagen[1] == "aac") {
                            $registro_imagen = "/icons/aac.png";
                        }else if ($imagen[1] == "ai") {
                            $registro_imagen = "/icons/ai.png";
                        }else if ($imagen[1] == "avi") {
                            $registro_imagen = "/icons/avi.png";
                        }else if ($imagen[1] == "bmp") {
                            $registro_imagen = "/icons/bmp.png";
                        }else if ($imagen[1] == "cad") {
                            $registro_imagen = "/icons/cad.png";
                        }else if ($imagen[1] == "cdr") {
                            $registro_imagen = "/icons/cdr.png";
                        }else if ($imagen[1] == "css") {
                            $registro_imagen = "/icons/css.png";
                        }else if ($imagen[1] == "dat") {
                            $registro_imagen = "/icons/dat.png";
                        }else if ($imagen[1] == "dll") {
                            $registro_imagen = "/icons/dll.png";
                        }else if ($imagen[1] == "dmg") {
                            $registro_imagen = "/icons/dmg.png";
                        }else if ($imagen[1] == "doc") {
                            $registro_imagen = "/icons/doc.png";
                        }else if ($imagen[1] == "eps") {
                            $registro_imagen = "/icons/eps.png";
                        }else if ($imagen[1] == "fla") {
                            $registro_imagen = "/icons/fla.png";
                        }else if ($imagen[1] == "flv") {
                            $registro_imagen = "/icons/flv.png";
                        }else if ($imagen[1] == "gif") {
                            $registro_imagen = "/icons/gif.png";
                        }else if ($imagen[1] == "html") {
                            $registro_imagen = "/icons/html.png";
                        }else if ($imagen[1] == "indd") {
                            $registro_imagen = "/icons/indd.png";
                        }else if ($imagen[1] == "iso") {
                            $registro_imagen = "/icons/iso.png";
                        }else if ($imagen[1] == "js") {
                            $registro_imagen = "/icons/js.png";
                        }else if ($imagen[1] == "midi") {
                            $registro_imagen = "/icons/midi.png";
                        }else if ($imagen[1] == "mov") {
                            $registro_imagen = "/icons/mov.png";
                        }else if ($imagen[1] == "mp3") {
                            $registro_imagen = "/icons/mp3.png";
                        }else if ($imagen[1] == "mpg") {
                            $registro_imagen = "/icons/mpg.png";
                        }else if ($imagen[1] == "php") {
                            $registro_imagen = "/icons/php.png";
                        }else if ($imagen[1] == "ppt") {
                            $registro_imagen = "/icons/ppt.png";
                        }else if ($imagen[1] == "pptx") {
                            $registro_imagen = "/icons/ppt.png";
                        }else if ($imagen[1] == "ps") {
                            $registro_imagen = "/icons/ps.png";
                        }else if ($imagen[1] == "psd") {
                            $registro_imagen = "/icons/psd.png";
                        }else if ($imagen[1] == "raw") {
                            $registro_imagen = "/icons/raw.png";
                        }else if ($imagen[1] == "sql") {
                            $registro_imagen = "/icons/sql.png";
                        }else if ($imagen[1] == "svg") {
                            $registro_imagen = "/icons/svg.png";
                        }else if ($imagen[1] == "tif") {
                            $registro_imagen = "/icons/tif.png";
                        }else if ($imagen[1] == "txt") {
                            $registro_imagen = "/icons/txt.png";
                        }else if ($imagen[1] == "wmv") {
                            $registro_imagen = "/icons/wmv.png";
                        }else if ($imagen[1] == "xls") {
                            $registro_imagen = "/icons/xls.png";
                        }else if ($imagen[1] == "xml") {
                            $registro_imagen = "/icons/xml.png";
                        }else if ($imagen[1] == "zip") {
                            $registro_imagen = "/icons/zip.png";
                        }else{
                            $registro_imagen = "document.png";
                        }
                    @endphp
                    <div class="col-md-4">
                        <a href="/{{$registro_corporativa->url}}" class="archivo_id" id="{{$registro_corporativa->id}}" base="http://socasesores.com/material/public/archivos/">
                            <div class="content-registro content-registro_archivo" style="background-image: url(http://socasesores.com/material/public/archivos/{{$registro_imagen}});"></div>
                            <p class="text-center">
                                {{$registro_corporativa->nombre}}
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
        <a class="download" href="" files="{{$archivos}}" base="http://socasesores.com/material/public/archivos/"><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
        <div class="dropdown">
          <button class="dropbtn"><i class="fas fa-share"></i>Compartir</button>
          <div class="dropdown-content">
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$registros[0]->url}}" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{$registros[0]->url}}" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="https://twitter.com/intent/tweet?url={{$registros[0]->url}}&text=" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
          </div>
        </div>
        <a class="copy" href="https://socasesores.com/material/public/archivos/{{$registros[0]->url}}"><i class="far fa-copy"></i> Copiar vínculo</a>
        @if (Auth::check() && Auth::user()->role == 0)
            <a class="delete" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>     
        @else
        @endif
    @endisset

    @empty($registros)
         <picture><img class="image_registro" src="" alt=""></picture>
        <h3 class="title"></h3>
        <p class="description"></p>
        <a class="download" href="" files="[]" base="https://socasesores.com/material/public/archivos/"><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
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
        @if (Auth::check() && Auth::user()->role == 0)
            <a class="delete-file" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>                 
        @else
        @endif
    @endempty
</section>
@endsection
