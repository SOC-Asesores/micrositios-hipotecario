<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Material | SOC Asesores</title>
    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ab58011517.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="bg-light fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                          <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{ url('img/soc.jpg') }}" width="150" class="d-inline-block align-top" alt="">
                          </a>
                          <div class="form-inline ml-auto" style="width: 100%;">
                            <input class="form-control m-auto" type="search" placeholder="Buscar" id="search" aria-label="Search">
                            @if (Auth::check())
                              @if( Auth::user()->role = 0)
                               <p>Hola</p>
                              @endif
                              <a data-toggle="modal" data-target="#exampleModal" class="add-button"><i class="fas fa-plus-circle"></i>Agregar Material</a>
                            @else
                              <a href="https://forms.gle/DtFY17W8MRj55hHv7" target="_blank" class="add-button">Solicitud de diseño</a>
                            @endif
                          </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}/identidad">Imagen Corporativa</a>
                              </li>
                              <li class="nav-item dropdown drop-menu">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Líneas de negocio
                                </a>
                                <div class="dropdown-menu dropdown-content drop-sub-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{url('/')}}/linea/hipotecario">Hipotecario</a>
                                  <a class="dropdown-item" href="{{url('/')}}/linea/empresarial">Empresarial</a>
                                  <a class="dropdown-item" href="{{url('/')}}/linea/seguros">Seguros y fianzas</a>
                                </div>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}/herramientas">Herramientas</a>
                              </li>
                              <li class="nav-item dropdown drop-menu">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Contenido de difusión
                                </a>
                                <div class="dropdown-menu dropdown-content dropdown drop-sub-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{url('/')}}/difusion/hipotecario">Hipotecario</a>
                                  <a class="dropdown-item" href="{{url('/')}}/difusion/empresarial">Empresarial</a>
                                  <a class="dropdown-item" href="{{url('/')}}/difusion/seguros">Seguros y fianzas</a>
                                </div>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}/eventos">Eventos</a>
                              </li>
                              <li>
                                <a href="https://forms.gle/JuUnJ2inFYL97FsR7" class="add-button-2" target="_blank">Tarjeta y firma digital</a>
                              </li>
                              <li>
                                <a href="#" class="button-help"><img src="{{url('/')}}/img/help.png" alt=""></a>
                              </li>
                              
                            </ul>
                          </div>
                        </nav>
                    </div>
                </div>
                <div class="modal-contact">
                  <p class="text-center mb-2"><b>¿En qué podemos ayudarte?</b></p>
                  <p>Manda un correo a:</p>
                  <a href="mailto:luishernandez@socasesores.com,acid@socasesores.com">Soporte técnico y UX</a><br>
                  <a href="mailto:dgarcia@socasesores.com">Desarrollo de contenido</a>
                </div>
            </div>
        </header>


        <main>
            @yield('content')
        </main>
        <!-- Modal -->
        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" style="border: 0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Agrega la siguiente información</p>
                <form id="multi-file-upload-ajax" method="post" action="{{url('insert')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="name" name="nombre" placeholder="Nombre">
                    <label for="files" id="file_label">Archivos a subir</label>
                    <input type="file" name="filenames[]" id="files" placeholder="Choose files" multiple hidden>
                    <select name="categoria_padre" id="category_padre">
                        <option value="" selected hidden>Guardar en</option>
                        <option value="corporativa" parent="">Imagen corporativa</option>
                        <option value="L1_hipotecario" parent="">Líneas de negocio - Hipotecario</option>
                        <option value="L1_empresarial" parent="">Líneas de negocio - Empresarial</option>
                        <option value="L1_seguros" parent="">Líneas de negocio - Seguros</option>
                        <option value="C1_hipotecario" parent="">Contenido de difusión - Hipotecario</option>
                        <option value="C1_empresarial" parent="">Contenido de difusión - Empresarial</option>
                        <option value="C1_seguros" parent="">Contenido de difusión - Seguros</option>
                        <option value="gaceta" parent="">Gaceta</option>
                        <option value="eventos" parent="">Eventos</option>
                    </select>
                    <select name="categoria" id="category" class="d-none">
                        
                    </select>
                    <input type="hidden" value="url({{ url('img/registros') }}" id="base_registro">
                    <input type="hidden" value="url({{ url('archivos') }}" id="base_imagen">
                    <textarea name="descripcion" cols="30" rows="7" placeholder="Descripcion" id="description"></textarea>
                    <input type="submit" value="Guardar">
                </form>
              </div>
            </div>
          </div>
        </div>
        <footer></footer>
    </div>
</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        $('#search').keypress(function (e) {
         var key = e.which;
         if(key == 13)  // the enter key code
          {
            window.open('{{url('/')}}/search/'+$('#search').val(), '_parent'); 
          }
        }); 
    $(".registro_id").click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var base = $(this).attr('base');
        $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{url('registro')}}",
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(response){
                    var date = formatDate(response['registros'][0].created_at);
                    var archivos = [];
                    $.each(response['archivos'], function(index, val) {
                        archivos.push(val.url);
                    });
                    $(".title").html(response['registros'][0].nombre);
                    $(".image_registro").attr("src",base+response['registros'][0].imagen);
                    $(".description").html(response['registros'][0].descripcion);
                    $("#facebook").attr("href","https://www.facebook.com/sharer/sharer.php?u=https://socasesores.com/material/public/archivo/"+response['registros'][0].url);
                    $("#twitter").attr("href","https://twitter.com/intent/tweet?url=https://socasesores.com/material/public/"+response['registros'][0].url+"&text=");
                    $("#linkedin").attr("href","https://www.linkedin.com/shareArticle?mini=true&url=https://socasesores.com/material/public/archivo/"+response['registros'][0].url);
                    $(".copy").attr("href","{{url('/')}}/carpeta/"+response['registros'][0].url);
                    $(".date span").html(date);
                    $(".info span").html(response['count']);
                    $(".delete").attr("id",response['registros'][0].id);
                    $(".open").attr("href","{{url('/')}}"+"/registro/"+response['registros'][0].url);
                    $(".registro-section").removeClass('hide');
                }
        });
    });
    $(".archivo_id").click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var base = $(this).attr('base');
        $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{url('archivo')}}",
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(response){
                    var archivos = [];
                    $.each(response['archivos'], function(index, val) {
                        archivos.push(val.url);
                    });
                    $(".title").html(response['archivos'][0].nombre);
                    $(".description").html(response['archivos'][0].descripcion);
                    $(".image_registro").attr("src",base+response['archivos'][0].imagen);
                    $("#facebook").attr("href","https://www.facebook.com/sharer/sharer.php?u=https://socasesores.com/material/public/archivos/"+response['archivos'][0].imagen);
                    $("#twitter").attr("href","https://twitter.com/intent/tweet?url=https://socasesores.com/material/public/archivos/"+response['archivos'][0].imagen+"&text=");
                    $("#linkedin").attr("href","https://www.linkedin.com/shareArticle?mini=true&url=https://socasesores.com/material/public/archivos/"+response['archivos'][0].imagen);
                    $("#whatsapp").attr("href","https://web.whatsapp.com/send?text=https://socasesores.com/material/public/archivos/"+response['archivos'][0].imagen);
                    $("#mailto").attr("href","mailto:body=https://socasesores.com/material/public/archivos/"+response['archivos'][0].imagen);
                    $(".copy").attr("href","https://socasesores.com/material/public/archivos/"+response['archivos'][0].imagen);
                    $(".delete-file").attr("id",response['archivos'][0].id);
                    $(".download").attr("files",response['archivos'][0].imagen);
                    $(".registro-section").removeClass('hide');
                }
        });
    });

    $(".delete").click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{url('delete')}}",
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(response){
                    alert("Carpeta eliminada");
                   window.open('{{url('/')}}','_parent'); 
                }
        });
    });

    $(".delete-file").click(function(e){
        e.preventDefault();
        text = window.location.href;
        var id = $(this).attr('id');
        $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{url('delete_file')}}",
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(response){
                    alert("Archivo eliminado");
                   window.open(text,'_parent'); 
                }
        });
    });

    function formatDate(date) {
         var d = new Date(date),
             month = '' + (d.getMonth() + 1),
             day = '' + d.getDate(),
             year = d.getFullYear();

         if (month.length < 2) month = '0' + month;
         if (day.length < 2) day = '0' + day;

         return [year, month, day].join('-');
    }


    $('#category_padre').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        switch (valueSelected) { 
        case 'corporativa': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="corporativa_brand_book">Brand book</option>`);
            $('#category').append(`<option value="corporativa_logo_soc">Logo - Soc</option>`);
            $('#category').append(`<option value="corporativa_tipografia">Tipografía</option>`);
            $('#category').append(`<option value="corporativa_plantilla_presentacion">Plantilla para presentación</option>`);
            $('#category').append(`<option value="corporativa_logo_hipotecario">Logo - Hipotecario</option>`);
            $('#category').append(`<option value="corporativa_logo_empresarial">Logo - Empresarial</option>`);
            $('#category').append(`<option value="corporativa_logo_seguros">Logo - Seguros y Finanzas</option>`);
            $('#category').append(`<option value="corporativa_papeleria_hoja_membretada">Papelería - Hoja membretada</option>`);
            $('#category').append(`<option value="corporativa_papeleria_plantilla_de_presentacion">Papelería - Plantilla de presentación</option>`);
            $('#category').append(`<option value="corporativa_presentacion_institucional">Presentación institucional</option>`);
            $('#category').append(`<option value="corporativa_videos_institucionales">Videos institucionales</option>`);
            break;
        case 'L1_hipotecario': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="l_hipotecario_presentaciones">Presentaciones</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_post_facebook">Redes Sociales - Post de Facebook</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_post_instagram">Redes Sociales - Post de Instagram</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_post_twitter">Redes Sociales - Post de Twitter</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_infografias">Redes Sociales - Infografías</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_frases">Redes Sociales - Frases</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_diario">Redes Sociales - ABCDario Financiero</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_promocion">Redes Sociales - Promoción de herramientas</option>`);
            $('#category').append(`<option value="l_hipotecario_redes_sociales_publicidad">Redes Sociales - Campaña de publicidad</option>`);
            $('#category').append(`<option value="l_hipotecario_stickers">Stickers</option>`);
            $('#category').append(`<option value="l_hipotecario_fotos_promocionales">Galería de imágenes para diseño</option>`);
            $('#category').append(`<option value="l_hipotecario_videos_promocionales">Videos promocionales</option>`);
            $('#category').append(`<option value="l_hipotecario_materiales_asesoria">Materiales publicitarios - Asesoría</option>`);
            $('#category').append(`<option value="l_hipotecario_materiales_firma">Materiales publicitarios - Firma</option>`);
            $('#category').append(`<option value="l_hipotecario_materiales_socios">Materiales publicitarios - Socios de negocio</option>`);
            $('#category').append(`<option value="l_hipotecario_materiales_servicio">Materiales publicitarios - Servicio</option>`);
            $('#category').append(`<option value="l_hipotecario_materiales_productos">Materiales publicitarios - Productos</option>`);
            $('#category').append(`<option value="l_hipotecario_kit_cliente_final">Kit de bienvenida - Cliente Final</option>`);
            $('#category').append(`<option value="l_hipotecario_plantillas_redes_sociales">Kit de bienvenida - Plantillas de Redes Sociales</option>`);
            $('#category').append(`<option value="l_hipotecario_efemerides">Kit de bienvenida - Efemérides</option>`);
            $('#category').append(`<option value="l_hipotecario_fondos_de_pantalla">Kit de bienvenida - Fondos de pantalla</option>`);
            $('#category').append(`<option value="l_hipotecario_firma_electronica">Kit de bienvenida - Firma electrónica</option>`);
            $('#category').append(`<option value="l_hipotecario_tarjeta_presentacion_digital">Kit de bienvenida - Tarjeta de presentación digital</option>`);
            break;
        case 'L1_empresarial': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="l_empresarial_presentaciones">Presentaciones</option>`);
            $('#category').append(`<option value="l_empresarial_redes_sociales_post_facebook">Redes Sociales - Post de Facebook</option>`);
            $('#category').append(`<option value="l_empresarial_redes_sociales_post_instagram">Redes Sociales - Post de Instagram</option>`);
            $('#category').append(`<option value="l_empresarial_redes_sociales_post_twitter">Redes Sociales - Post de Twitter</option>`);
            $('#category').append(`<option value="l_empresarial_redes_sociales_infografias">Redes Sociales - Infografías</option>`);
            $('#category').append(`<option value="l_empresarial_redes_sociales_frases">Redes Sociales - Frases</option>`);
            $('#category').append(`<option value="l_empresarial_redes_sociales_diario">Redes Sociales - ABCDario Financiero</option>`);
            $('#category').append(`<option value="l_empresarial_stickers">Stickers</option>`);
            $('#category').append(`<option value="l_empresarial_fotos_promocionales">Galería de imágenes para diseño</option>`);
            $('#category').append(`<option value="l_empresarial_videos_promocionales">Videos promocionales</option>`);
            $('#category').append(`<option value="l_empresarial_materiales_productos">Materiales publicitarios - Productos</option>`);
            $('#category').append(`<option value="l_empresarial_kit_cliente_final">Kit de bienvenida - Cliente Final</option>`);
            $('#category').append(`<option value="l_empresarial_plantillas_redes_sociales">Kit de bienvenida - Plantillas de Redes Sociales</option>`);
            $('#category').append(`<option value="l_empresarial_efemerides">Kit de bienvenida - Efemérides</option>`);
            $('#category').append(`<option value="l_empresarial_fondos_de_pantalla">Kit de bienvenida - Fondos de pantalla</option>`);
            $('#category').append(`<option value="l_empresarial_firma_electronica">Kit de bienvenida - Firma electrónica</option>`);
            $('#category').append(`<option value="l_empresarial_tarjeta_presentacion_digital">Kit de bienvenida - Tarjeta de presentación digital</option>`);
            break;      
        case 'L1_seguros': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="l_seguros_presentaciones">Presentaciones</option>`);
            $('#category').append(`<option value="l_seguros_redes_sociales_post_facebook">Redes Sociales - Post de Facebook</option>`);
            $('#category').append(`<option value="l_seguros_redes_sociales_post_instagram">Redes Sociales - Post de Instagram</option>`);
            $('#category').append(`<option value="l_seguros_redes_sociales_post_twitter">Redes Sociales - Post de Twitter</option>`);
            $('#category').append(`<option value="l_seguros_redes_sociales_infografias">Redes Sociales - Infografías</option>`);
            $('#category').append(`<option value="l_seguros_redes_sociales_frases">Redes Sociales - Frases</option>`);
            $('#category').append(`<option value="l_seguros_redes_sociales_diario">Redes Sociales - ABCDario Financiero</option>`);
            $('#category').append(`<option value="l_seguros_stickers">Stickers</option>`);
            $('#category').append(`<option value="l_seguros_fotos_promocionales">Galería de imágenes para diseño</option>`);
            $('#category').append(`<option value="l_seguros_videos_promocionales">Videos promocionales</option>`);
            $('#category').append(`<option value="l_seguros_materiales_productos">Materiales publicitarios - Productos</option>`);
            $('#category').append(`<option value="l_seguros_kit_cliente_final">Kit de bienvenida - Cliente Final</option>`);
            $('#category').append(`<option value="l_seguros_plantillas_redes_sociales">Kit de bienvenida - Plantillas de Redes Sociales</option>`);
            $('#category').append(`<option value="l_seguros_efemerides">Kit de bienvenida - Efemérides</option>`);
            $('#category').append(`<option value="l_seguros_fondos_de_pantalla">Kit de bienvenida - Fondos de pantalla</option>`);
            $('#category').append(`<option value="l_seguros_firma_electronica">Kit de bienvenida - Firma electrónica</option>`);
            $('#category').append(`<option value="l_seguros_tarjeta_presentacion_digital">Kit de bienvenida - Tarjeta de presentación digital</option>`);
            break;
        case 'eventos': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="l_eventos_fotos_aula_soc">Fotos - Aula SOC</option>`);
            $('#category').append(`<option value="l_eventos_fotos_convenccion">Fotos - Convención</option>`);
            $('#category').append(`<option value="l_eventos_fotos_lideres">Fotos - Líderes</option>`);
            $('#category').append(`<option value="l_eventos_fotos_workshop">Fotos - Workshop</option>`);
            $('#category').append(`<option value="l_eventos_videos_convenccion_2019">Videos - Convención 2019</option>`);
            $('#category').append(`<option value="l_eventos_proximos_eventos_aula_mayo">Próximos eventos - Aula Mayo</option>`);
            $('#category').append(`<option value="l_eventos_proximos_eventos_aula_junio">Próximos eventos - Aula Junio</option>`);
            $('#category').append(`<option value="l_eventos_proximos_eventos_workshop">Próximos eventos - Workshop</option>`);
            break;
        case 'gaceta': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="gaceta_hipotecario">Gaceta - Hipotecario</option>`);
            $('#category').append(`<option value="gaceta_empresarial">Gaceta - Empresarial</option>`);
            $('#category').append(`<option value="gaceta_seguros">Gaceta - Seguros</option>`);
            break;
        case 'C1_hipotecario': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="C_hipotecario_racing_broker">SOC Racing - broker</option>`);
            $('#category').append(`<option value="C_hipotecario_racing_inmobiliaria">SOC Racing - inmobiliaria</option>`);
            $('#category').append(`<option value="C_hipotecario_comparador_broker">Comparador - broker</option>`);
            $('#category').append(`<option value="C_hipotecario_comparador_inmobiliaria">Comparador - inmobiliaria</option>`);
            $('#category').append(`<option value="C_hipotecario_comparador_cliente_final">Comparador - cliente final</option>`);
            $('#category').append(`<option value="C_hipotecario_alerta_v3">Alerta V3</option>`);
            $('#category').append(`<option value="C_hipotecario_campana_datos">Campaña base de datos</option>`);
            break;
        case 'C1_empresarial': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="C_empresarial_perfilador_broker">Perfilador - broker</option>`);
            $('#category').append(`<option value="C_empresarial_perfilador_empresas">Perfilador - empresas</option>`);
            $('#category').append(`<option value="C_empresarial_networking">Networking</option>`);
            break;
        case 'C1_seguros': 
            $("#category").html("");
            $("#category").removeClass("d-none");
            $('#category').append(`<option value="C_seguros_comparador_broker">Comparador de seguros - broker</option>`);
            $('#category').append(`<option value="C_seguros_comparador_cliente">Comparador de seguros - cliente final</option>`);
            $('#category').append(`<option value="C_seguros_mesa_del_millon">Mesa del Millón</option>`);
            break;
        default:
            $("#category").html("");
    }
    });
    </script>
</html>
