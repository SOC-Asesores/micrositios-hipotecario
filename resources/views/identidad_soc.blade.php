@extends('layouts.app_identidad')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Tarjeta de presentación</h1>
                    <p>Revisa o actualiza tu información</p>
                    <form action="{{route('sendIdentidad')}}" method="post">
                        @csrf
                        <input type="text" placeholder="Nombre Completo">
                        <input type="text" placeholder="Puesto">
                        <input type="text" name="departamento" id="departamento" placeholder="Departamento">
                        <input type="number" placeholder="Numero de telefono">
                        <input type="email" placeholder="Correo electronico">
                        <p>Redes Sociales</p>
                        <span>Los campos no son obligatorios</span>
                        <input type="text" placeholder="Facebook">
                        <input type="text" placeholder="Linkedin">
                        <input type="submit" placeholder="Generar firma">
                    </form>
                </div>
                <div class="col-md-6">
                    <h2>Mi nueva tarjeta de presentación</h2>
                    <b>Anverso</b>
                    
                        <div class="anverso">
                            <div class="anverso_1">
                                <img src="https://i.ibb.co/KyjB8mn/soc.jpg" alt="">
                            </div>
                            <div class="anverso_2">
                                <p>Developer</p>
                            </div>
                        </div>
                   <br><br>
                    <b>Reverso</b>
                    <div class="reverso">
                        <div class="reverso_head">
                            <h2>Luis Felipe Hernández Vergara</h2>
                            <p><span>Developer</span></p>
                        </div>
                        <div class="reverso_1">
                            <p>
                                5120 5731<br>
                                55 2345 3545<br>
                                luis.hernandez@socasesores.com<br>
                                socasesores.com
                            </p>
                        </div>
                        <div class="reverso_2">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100" height="100" viewBox="0 0 100 100"><rect x="0" y="0" width="100" height="100" fill="#ffffff"></rect><g transform="scale(4.762)"><g transform="translate(0,0)"><path fill-rule="evenodd" d="M9 0L9 1L8 1L8 2L9 2L9 3L8 3L8 4L9 4L9 3L10 3L10 2L9 2L9 1L10 1L10 0ZM12 0L12 1L11 1L11 2L12 2L12 1L13 1L13 0ZM11 3L11 4L10 4L10 5L8 5L8 7L9 7L9 6L10 6L10 8L6 8L6 9L7 9L7 10L6 10L6 11L4 11L4 9L5 9L5 8L0 8L0 9L1 9L1 10L2 10L2 11L1 11L1 13L2 13L2 12L3 12L3 13L4 13L4 12L6 12L6 13L7 13L7 12L6 12L6 11L8 11L8 12L9 12L9 13L8 13L8 15L9 15L9 16L8 16L8 21L12 21L12 20L11 20L11 19L14 19L14 17L15 17L15 18L18 18L18 17L17 17L17 15L18 15L18 16L19 16L19 17L21 17L21 15L20 15L20 14L21 14L21 13L20 13L20 12L21 12L21 11L20 11L20 10L21 10L21 9L20 9L20 8L19 8L19 9L18 9L18 8L17 8L17 9L16 9L16 8L15 8L15 10L14 10L14 8L13 8L13 4L12 4L12 3ZM11 4L11 7L12 7L12 4ZM10 8L10 10L8 10L8 11L10 11L10 10L13 10L13 8L12 8L12 9L11 9L11 8ZM2 9L2 10L3 10L3 9ZM15 10L15 11L14 11L14 12L13 12L13 11L12 11L12 13L11 13L11 12L10 12L10 13L11 13L11 14L10 14L10 16L11 16L11 17L10 17L10 18L9 18L9 19L10 19L10 18L13 18L13 17L14 17L14 16L15 16L15 17L16 17L16 15L17 15L17 14L13 14L13 13L14 13L14 12L15 12L15 13L16 13L16 11L17 11L17 10ZM18 10L18 11L19 11L19 10ZM3 11L3 12L4 12L4 11ZM18 12L18 13L19 13L19 12ZM11 14L11 16L12 16L12 17L13 17L13 16L14 16L14 15L13 15L13 14ZM18 14L18 15L19 15L19 16L20 16L20 15L19 15L19 14ZM12 15L12 16L13 16L13 15ZM16 19L16 20L19 20L19 21L20 21L20 20L19 20L19 19ZM14 20L14 21L15 21L15 20ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z" fill="#000000"></path></g></g></svg>
                        </div>
                        <div class="reverso_footer">
                            <ul>
                                <li><img src="https://i.ibb.co/DC9zkJ3/001-instagram.png" alt="">@Soc_asesores</li>
                                <li><img src="https://i.ibb.co/jh9LYSY/002-facebook.png" alt="">@Soc_asesores</li>
                                <li><img src="https://i.ibb.co/xmCSgSg/003-twitter.png" alt="">@Soc_asesores</li>
                                <li><img src="https://i.ibb.co/T04YQ0M/004-linkedin.png" alt="">@Soc_asesores</li>
                            </ul>
                        </div>
                    </div>
                    <br><br>
                    <b>Firma Digital</b>
                        <div class="firma">
                            <div class="firma_2">
                                <img src="https://i.ibb.co/KyjB8mn/soc.jpg" alt="">
                                <p>Developer</p>
                            </div>
                            <div class="firma_1">
                                <div class="firma_head">
                                    <h2>Luis Felipe Hernández Vergara</h2>
                                    <p><span>Developer</span></p>
                                </div>
                                <p>
                                    5120 5731<br>
                                    55 2345 3545<br>
                                    luis.hernandez@socasesores.com<br>
                                    socasesores.com
                                </p>
                            </div>
                            <div class="firma_footer">
                                <ul>
                                    <li><img src="https://i.ibb.co/DC9zkJ3/001-instagram.png" alt="">@Soc_asesores</li>
                                    <li><img src="https://i.ibb.co/jh9LYSY/002-facebook.png" alt="">@Soc_asesores</li>
                                    <li><img src="https://i.ibb.co/xmCSgSg/003-twitter.png" alt="">@Soc_asesores</li>
                                    <li><img src="https://i.ibb.co/T04YQ0M/004-linkedin.png" alt="">@Soc_asesores</li>
                                </ul>
                            </div>
                        </div>
                    <b>Tarjeta Digital</b>
                        <div class="tarjeta">
                            <div class="tarjeta_header">
                                <img src="https://i.ibb.co/3ySb7qM/logo-white.png" alt="">
                            </div>
                            <div class="tarjeta_body">
                                <div class="profile-border">
                                    <div class="profile" style="background-image: url(https://i.ibb.co/Tq8R641/18485366-10211856119145815-8960670523567062089-n.jpg)"></div>
                                </div>
                            </div>
                            <div class="tarjeta_description">
                                <h1>Luis Felipe Hernández Vergara</h1>
                                <h2>Developer</h2>
                                <p>5120 5731</p>
                                <p>55 2345 3545</p>
                                <p>avazquez@socasesores.com</p>
                            </div>
                            <div class="tarjeta_social">
                                <ul>
                                    <li><img src="https://socasesores.com/marketing/img/001-facebook.png" alt=""></li>
                                    <li><img src="https://socasesores.com/marketing/img/002-linkedin.png" alt=""></li>
                                    <li><img src="https://socasesores.com/marketing/img/003-instagram.png" alt=""></li>
                                    <li><img src="https://socasesores.com/marketing/img/004-twitter.png" alt=""></li>
                                    <li><img src="https://socasesores.com/marketing/img/005-youtube.png" alt=""></li>
                                </ul>
                            </div>
                            <div class="tarjeta_footer">
                                <p>socasesores.com</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
