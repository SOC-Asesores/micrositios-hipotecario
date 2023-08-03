@extends('layouts.app_user')

@section('content')
<section class="home-section home-1">
    <div class="container">
            @if(!$archivos->isEmpty())
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="titulo-categoria" style="text-transform: capitalize;">{{$titulo}}</h2>
                     @if (Auth::check() && Auth::user()->role == 0)
                        <div>
                            <input type="text" value="{{$titulo}}" class="mb-4 d-none form-control edit_name_titulo" name="edit_name_titulo">
                            <input type="text" id="id_titulo" value="{{ $id_titulo }}" hidden name="id_titulo">
                        </div>
                        
                        <a href="" class="mr-4 change-name_titulo">Cambiar nombre <i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="" class="delete-folder">Borrar carpeta <i class="fa-solid fa-folder-minus"></i></a>
                    @endif
                    <div>
                        <a class="save-changes-folder btn btn-info d-none mt-4" href=""><i class="fa-solid fa-floppy-disk"></i>Guardar Cambios</a>
                    </div>
                </div>
                @foreach ($archivos as $registro_corporativa)
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
                        }else if ($imagen[1] == "mp4") {
                            $registro_imagen = "/icons/mp4.png";
                        }else{
                            $registro_imagen = "document.png";
                        }
                    @endphp
                    <div class="col-md-4">
                        <a href="/{{$registro_corporativa->url}}" class="archivo_id" id="{{$registro_corporativa->id}}" base="{{ url('archivos') }}/">
                            <div class="content-registro content-registro_archivo" style="background-image: url({{ url('archivos') }}/{{$registro_imagen}});"></div>
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
        <img class="image_registro" src="{{ url('archivos') }}/{{$registros[0]->imagen}}" alt="">
        <div class="position-relative"><h3 class="title"><span>{{$registros[0]->nombre}}</span></h3><a href="">Cambiar nombre <i class="fa-solid fa-pen-to-square"></i></a></div>
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
            <a href="mailto:{{$registros[0]->url}}&text=" target="_blank"><i class="fab fa-twitter"></i> Mail</a>
          </div>
        </div>
        <a class="copy" href="/{{$registros[0]->url}}"><i class="far fa-copy"></i> Copiar vínculo</a>
        @if (Auth::check() && Auth::user()->role == 0)
         <a class="delete" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>
        @endif
    @endisset

    @empty($registros)
        <picture><img class="image_registro" src="" alt=""></picture>
        <div class="position-relative">
            <h3 class="title"> <span></span></h3>
            @if (Auth::check() && Auth::user()->role == 0)
                <div>
                    <input type="text" class="d-none form-control edit_name" name="edit_name">
                    <input type="text" id="edit_id" hidden name="edit_id">
                </div>
                <div class="change-folder d-none">
                    <select name="categoria_padre" class="custom-select" id="category_padre">
                        <option value="" selected hidden>Guardar en</option>
                         @foreach($folders as $folder)
                          <option value="{{ $folder->slug }}" parent="">{{ $folder->name }}</option>
                        @endforeach
                    </select>
                    <select name="categoria" id="category" class="category_change d-none custom-select"></select>
                </div>
                <a href="" class="change-name">Cambiar nombre <i class="fa-solid fa-pen-to-square"></i></a>
                <a href="" class="change-folder-link">Mover de carpeta <i class="fa-solid fa-folder"></i></a>
            @endif
        </div>
        <p class="description"></p>
        <a class="save-changes btn btn-info d-none" href=""><i class="fa-solid fa-floppy-disk"></i>Guardar Cambios</a>
        <a class="download" href="" files="[]" base="{{ url('archivos') }}/" download><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
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
        <a class="copy" href="" ><i class="far fa-copy"></i> Copiar vínculo</a>
        @if (Auth::check() && Auth::user()->role == 0)
         <a class="delete-file" id="" href=""><i class="far fa-trash-alt"></i> Eliminar</a>  
        @endif
    @endempty
</section>
@endsection
