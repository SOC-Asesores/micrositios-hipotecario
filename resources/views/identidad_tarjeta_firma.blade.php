<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>{{$registro->name}} | {{$registro->puesto}}</title>
    <style>
        .tarjeta{
            width: 100%;
            margin: 0 auto;
			max-width: 550px;
			overflow: hidden;
		}
		.tarjeta_header{
			background: #E2F1F8;
			padding-bottom: 130px;
			padding-top: 10px;
		}
		.tarjeta_header img{
			width: 33%;
			display: block;
			margin: 0 auto;
		}
		.tarjeta_body .profile{
			width: 220px;
			height: 220px;
			border-radius: 100%;
			display: block;
			margin: 0 auto;
			background-size: cover;
			background-position: center;
		}
		.profile-border{
			background: linear-gradient(90deg, rgba(2, 88, 150, 1) 0%, rgba(35, 166, 211, 1) 50%, rgba(74, 168, 82, 1) 100%);
			width: 230px;
			height: 230px;
			display: flex;
			align-items: center;
			border-radius: 100%;
			margin: 0 auto;
			margin-top: -110px;
		}
		.tarjeta_description h1{
			font-size: 1.5rem;
			font-weight: bold;
			margin-bottom: 0;
			margin-top: 2rem;
			color: #004F89;
			text-align: center;
		}
		.tarjeta_description h2{
			font-size: 1.3rem;
			margin-bottom: 4rem;
			font-weight: 100;
			margin-top: 1rem;
			color: #40516F;
			text-align: center;
		}
		.tarjeta_description p{
			font-size: 1.3rem;
			font-weight: bold;
			margin-top: 0rem;
			margin-bottom: 0rem;
			color: #40516F;
			text-align: center;
		}
		.tarjeta_footer{
			min-height: 35px;
			color: #fff;
			font-weight: normal;
			font-size: 1.3rem;
			text-align: center;
			width: 100%;
			background: rgb(2, 88, 150);
			margin-top: 1rem;
			background: linear-gradient(90deg, rgba(2, 88, 150, 1) 0%, rgba(35, 166, 211, 1) 50%, rgba(74, 168, 82, 1) 100%);
		}
        .tarjeta_footer a{
            color: #fff;
        }
		.tarjeta_social ul{
			list-style: none;
			padding-left: 0;
			margin-left: 0;
			margin-top: 3rem;
			margin-bottom: 1rem;
			text-align: center;
		}
		.tarjeta_social ul li{
			display: inline-block;
			margin-right: 10px;
		}
    </style>
  </head>
  <body>
  <div class="tarjeta">
                            <div class="tarjeta_header">
                                <img src="https://i.ibb.co/3ySb7qM/logo-white.png" alt="">
                            </div>
                            <div class="tarjeta_body">
                                <div class="profile-border">
                                    <div class="profile" style="background-image: url({{$registro->imagen}})"></div>
                                </div>
                            </div>
                            <div class="tarjeta_description">
                                <h1>{{$registro->name}}</h1>
								<h2>{{$registro->departamento}}</h2>
                                <h2>{{$registro->puesto}}</h2>
                                <p>{{$registro->telefono}}</p>
                                <p>{{$registro->celular}}</p>
                                <p>{{$registro->email}}</p>
                            </div>
                            <div class="tarjeta_social">
                                <ul>
									@if($registro->facebook != null)
										<li><a target="_blank" href="{{$registro->facebook}}"><img src="https://socasesores.com/marketing/img/001-facebook.png" alt=""></a></li>
									@endif
									
									@if($registro->linkedin != null)
										<li><a target="_blank" href="{{$registro->linkedin}}"><img src="https://socasesores.com/marketing/img/002-linkedin.png" alt=""></a></li>
									@endif

									@if($registro->instagram != null)
										<li><a target="_blank" href="{{$registro->instagram}}"><img src="https://socasesores.com/marketing/img/003-instagram.png" alt=""></a></li>
									@endif

									@if($registro->twitter != null)
										<li><a target="_blank" href="{{$registro->twitter}}"><img src="https://socasesores.com/marketing/img/004-twitter.png" alt=""></a></li>
									@endif
                                </ul>
                            </div>
                            <div class="tarjeta_footer">
                                <p> <a href="https://socasesores.com/" target="_blank">socasesores.com</a></p>
                            </div>
                        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>