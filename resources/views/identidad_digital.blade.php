@extends('layouts.app_identidad')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row tarjetas-form">
                <div class="col-md-3">
                    <div class="row">
                        <ul>
                            <li><a href="{{url('/')}}/identidad_presentacion">Tarjeta de presentación digital</a></li>
                            <li><a href="{{url('/')}}/identidad_digital" class="active">Tarjeta digital</a></li>
                            <li><a href="{{url('/')}}/identidad_firma">Firma de correo</a></li>
                            <li class="imprimir_link"><a href="{{url('/')}}/imprimir">Imprimir tarjetas</a></li>
                        
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <h1>Tarjeta digital</h1>
                    <p>Revisa o actualiza tu información</p>
                    <form action="{{route('sendIdentidadTarjeta')}}" method="post">
                        @csrf
                        <label for="">Nombre Completo</label>
                        <input type="text" placeholder="Ej. Juan Hernández" name="nombre" required>
                        <label for="">Puesto</label>
                        <input type="text" placeholder="Ej. Asesor hipotecario" name="puesto" required>
                        <label for="">Departamento</label>
                        <input type="text" name="departamento" id="departamento" placeholder="Ej: Marketing" required>
                        <label for="">Número de teléfono</label>
                        <input type="number" placeholder="Ej. xx xxxx xxxx" name="telefono">
                        <label for="">Celular</label>
                        <input type="number" placeholder="Ej. xx xxxx xxxx" name="celular">
                        <label for="">Correo electrónico</label>
                        <input type="email" placeholder="Ej. email@dominio.com" name="email" required>
                        <p>Foto</p>
                        <input type="text" placeholder="Url de tu foto" name="foto" required>
                        <p>Redes Sociales</p>
                        <label for="" class="d-block">Facebook</label>
                        www.facebook.com/<input type="text" class="d-inline w-50" placeholder="ingresa tu nombre de usuario" name="facebook">
                        <label for="" class="d-block">Linkedin</label>
                        www.linkedin.com/ <input type="text" class="d-inline w-50" placeholder="ingresa tu nombre de usuario" name="linkedin">
                        <label for="" class="d-block">Instagram</label>
                        www.instagram.com/<input type="text" class="d-inline w-50" placeholder="ingresa tu nombre de usuario" name="instagram">
                        <label for="" class="d-block">Twitter</label>
                        www.twitter.com/<input type="text" class="d-inline w-50" placeholder="ingresa tu nombre de usuario" name="twitter">
                        <input type="submit" placeholder="Generar firma">
                    </form>
                </div>
                <div class="col-md-4 d-flex justify-content-center flex-column text-center">
                    <h1 class="text-center">Mi nueva tarjeta digital</h1>
                    @isset($url)
                        <a href="{{url('/')}}/tarjeta_digital/{{$url}}" target="_blank">{{url('/')}}/tarjeta_digital/{{$url}}</a>
                    @endisset
                </div>
            </div>
        </div>
    </section>
@endsection
