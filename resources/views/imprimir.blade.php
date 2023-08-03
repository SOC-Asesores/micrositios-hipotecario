@extends('layouts.app_identidad')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row tarjetas-form">
                <div class="col-md-3">
                    <div class="row">
                        <ul>
                            <li><a href="{{url('/')}}/identidad_presentacion">Tarjeta de presentación</a></li>
                            <li><a href="{{url('/')}}/identidad_digital">Tarjeta digital</a></li>
                            <li><a href="{{url('/')}}/identidad_firma">Firma de correo</a></li>
                            <li class="imprimir_link"><a href="{{url('/')}}/imprimir" class="active">Imprimir tarjetas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>Imprimir tarjetas de presentación</h1>
                    <p class="blue-color"><strong>Costos</strong></p>
                    <ul style="list-style: disc; padding-left: 1rem;">
                        <li>La impresión de las tarjetas de presentación tiene un costo de $236 + IVA.</li>
                        <li>Puedes recogerlas en Hamburgo #290.</li>
                        <li>El costo de envío a domicilio es de $191 + IVA.</li>
                        <li>El tiempo aproximado de entrega es de 4 días hábiles</li>
                    </ul>
                    <p class="blue-color"><strong>Datos bancarios</strong></p>
                    <p>Banco de destino: Banorte</p>
                    <p>Cuenta destino: 072180010558290608</p>
                    <p>Nombre del beneficiario: Fin Ya SA de CV</p>
                    <p class="blue-color"><strong>Confirmar impresión</strong></p>
                    <form action="{{ route('sendMail') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="tarjeta">Adjuntar tarjeta de presentación Anverso</label><br>
                        <input class="form-control" type="file" name="tarjeta" id="tarjeta">
                        <label for="tarjeta">Adjuntar tarjeta de presentación Reverso</label><br>
                        <input class="form-control" type="file" name="tarjeta_2" id="tarjeta_2">
                        <label for="pago">Adjuntar comprobante de pago</label>
                        <input type="file" class="form-control" name="pago" id="pago">
                        <div>
                            <input type="submit" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
