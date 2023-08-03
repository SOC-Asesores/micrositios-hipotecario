@extends('layouts.main')

@section('content')
    <section class="folder-1 {{$url_folder}}">
        <h1 class="{{$url_folder}}">
            {{-- $title_folder --}}

            <div class="position-relative">
                <p class="title menu-more" id="menu-more-{{$id_folder}}"><span>{{$title_folder}}</span> <a href="" class="more-link" data-id="{{$id_folder}}"><img src="{{ url('img/more.png') }}" alt="" class="img-fluid"></a></p>
                <input type="text" class="more-name form-control d-none" id="more-name-{{ $id_folder }}" data-id="{{ $id_folder }}" data-type="folder" value="{{$title_folder}}">
                <div class="menu-more-items d-none" id="more_{{$id_folder}}">
                    <a href="" class="more_name_link d-block" data-type="folder" data-id="{{ $id_folder }}">Cambiar nombre</a>
                </div>
            </div>
        </h1>
        <div class="container mb-4">
            <div class="row justify-content-between" style="min-height:48px;">
                <div class="col-12 mb-4">
                    <div class="delete-multiple-btn" style="display:none;">
                        <div class="position-relative mr-4 d-inline-block">
                            <a href="#" class="mr-4 clone-multiple"><i class="fa-solid fa-copy"></i> Duplicar seleccionados</a>
                            <form id="duplicate_container">
                                <small><b>Duplicar a:</b></small>
                                <select name="duplicate_folder" id="duplicate_folder">
                                    <option value hidden selected>Selecciona una opci&oacute;n</option>
                                    {{-- Rellenar opciones --}}
                                    @foreach($folders_main as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <select name="duplicate_subfolder" id="duplicate_folder_child" class="d-none"></select>
                                <input type="submit" class="btn btn-success text-sm" value="Duplicar">
                            </form>
                        </div>
                        
                        <div class="position-relative mr-4 d-inline-block">
                            <a href="#" class="mr-4 move-multiple"><i class="fa-solid fa-arrows-up-down-left-right"></i> Mover seleccionados</a>
                            <form id="move_container">
                                <small><b>Mover a:</b></small>
                                <select name="move_folder" id="move_folder">
                                    <option value hidden selected>Selecciona una opci&oacute;n</option>
                                    {{-- Rellenar opciones --}}
                                    @foreach($folders_main as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <select name="folder" id="move_folder_child" class="d-none"></select>
                                <input type="submit" class="btn btn-success text-sm" value="Mover">
                            </form>
                            
                        </div>
                        <a href="" class="mr-4 delete-multiple" data-toggle="modal" data-target="#exampleModalDelete2" style="color: red;"><i class="fa-solid fa-trash-can"></i> Eliminar archivos seleccionados</a>
                        <a href="" id="cancel_selection"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
                <div class="col-12 text-right view-select" style="justify-self:end;">
                    <a href="" id="cuadricula" class="mr-4"><img src="{{ url('img/cuadricula.png') }}" alt="" class="img-fluid"></a>
                        <a href="" id="lista"><img src="{{ url('img/lista.png') }}" alt="" class="img-fluid"></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-start">
                @foreach($sub_folders as $key => $sub_folder)
                    @if (isset($sub_folder->id_folder))
                        @if ($id_folder === $sub_folder->id_folder)
                            <div class="col-md-2">
                                @if (Auth::check())   
                                    @if(Auth::user()->type == 0)
                                        <label class="floating-checkbox floating-checkbox-2">
                                            <input type="checkbox" class="form-check-input folder_multiple" data-id="{{ $sub_folder->id }}" name="select_folder[]">
                                        </label>
                                    @endif
                                @endif
                                <a href="{{url('/')}}/folder/{{$sub_folder->url}}" id="folder_{{$sub_folder->id}}">
                                    <div class="content text-center relative" style="box-shadow: 0px 3px 6px #00000029; border-radius: 5px; padding: 10px">
                                        <img src="{{url('img')}}/{{$sub_folder->img}}" class="img-fluid" alt="">
                                        {{-- <p class="{{ $sub_folder->hide == 0 ? '' : 'd-none' }}">{{ strlen($sub_folder->name) > 35 ? substr($sub_folder->name, 0, 35).'...' : $sub_folder->name}}</p> --}}
                                        {{-- <div class="position-relative"> --}}
                                            <span class="menu-more" id="menu-more-{{$sub_folder->id}}">
                                                <p class="{{ $sub_folder->hide == 0 ? '' : 'd-none' }}">{{ strlen($sub_folder->name) > 35 ? substr($sub_folder->name, 0, 35).'...' : $sub_folder->name}}</p>
                                            </span>
                                            <input type="text" class="more-name form-control d-none" id="more-name-{{ $sub_folder->id }}" data-id="{{ $sub_folder->id }}" data-type="folder" value="{{$sub_folder->name}}">
                                        {{-- </div> --}}
                                    </div>
                                </a>
                                @if (Auth::check() && Auth::user()->type == 0)
                                    <span class="more-link more-link-floating" data-id="{{$sub_folder->id}}"></span>
                                    <div class="menu-more-items small-more-items d-none" id="more_{{$sub_folder->id}}">  
                                        <a href="" class="more_name_link d-block" data-type="folder" data-id="{{ $sub_folder->id }}">Cambiar nombre</a>
                                        <a href="" class="select_link" data-id="{{ $sub_folder->id }}">Seleccionar</a>     
                                        <a class="delete delete_folder link_folder_{{$sub_folder->id}}" id="{{$sub_folder->id}}" href="">Eliminar</a>                 
                                    </div>
                                                        @else
                                                        @endif
                            </div>
                        @endif
                    @endif
                @endforeach
            </div> 
            <div class="row align-items-start">
                @foreach($archives as $key => $archives)
                    @if (isset($archives->id_folder))
                        @if ($id_folder === $archives->id_folder)
                            <div class="col-md-2">  
                                @if (Auth::check())   
                                    @if(Auth::user()->type == 0)
                                        <label class="floating-checkbox floating-checkbox-2">
                                            <input type="checkbox" class="form-check-input archivos_multiple" data-id="{{ $archives->id }}" name="select[]">
                                        </label>
                                    @endif
                                @endif
                                <a href="{{url('img')}}/archivos/{{$archives->img}}" id="files_{{$archives->id}}" target="_blank">
                                    <div class="content text-center">
                                        @php
                                            $imagen = explode(".", $archives->img);
                                            if (end($imagen) == "jpg" || end($imagen) == "png" || end($imagen) == "jpeg") {
                                                $registro_imagen = "archivos/".$archives->img;
                                            }else if ($imagen[1] == "pdf") {
                                                $registro_imagen = "/icons/pdf.png";
                                            }else if ($imagen[1] == "3ds") {
                                                $registro_imagen = "/icons/3ds.png";
                                            }else if ($imagen[1] == "jpeg") {
                                                                            $registro_imagen = "/icons/jpg.png";
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
                                            }else if ($imagen[1] == "xlsx") {
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
                                        <img src="{{url('img')}}/{{$registro_imagen}}" class="img-fluid" {{ end($imagen) != "jpg" && end($imagen) != "png" && end($imagen) != "jpeg" ? 'width=60' : '' }}  alt="">

                                         {{-- <p class="{{ $archives->hide == 0 ? '' : 'd-none' }}">{{ strlen($archives->img) > 35 ? substr($archives->img, 0, 35).'...' : $archives->img }}</p> --}}

                                        <div class="position-relative">
                                            <p class="menu-more" id="menu-more-{{$archives->id}}">
                                                <span class="{{ $archives->hide == 0 ? '' : 'd-none' }}">{{ strlen($archives->img) > 35 ? substr($archives->img, 0, 35).'...' : $archives->img }}</span>
                                            </p>
                                            <input type="text" class="more-name form-control d-none" id="more-name-{{ $archives->id }}" data-id="{{ $archives->id }}" data-type="file" value="{{ $archives->img }}">
                                        </div>

                                    </div>
                                </a>
                                 @if (Auth::check() && Auth::user()->type == 0)
                                    <span class="more-link more-link-floating" data-id="{{$archives->id}}"></span>
                                    <div class="menu-more-items small-more-items d-none" id="more_{{$archives->id}}">
                                        <a href="" class="more_name_link d-block" data-type="file" data-id="{{ $archives->id }}">Cambiar nombre</a>
                                        <a href="" class="select_link" data-id="{{ $archives->id }}">Seleccionar</a>
                                        <a class="delete delete_file link_files_{{$archives->id}}" id="{{$archives->id}}" href="">Eliminar</a>                 
                                    </div>
                                                            @else
                                                            @endif
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <style>.more-name{padding-right:1.65em}.more-name-btn-submit{right:0;bottom:.65em;}</style>
@endsection
