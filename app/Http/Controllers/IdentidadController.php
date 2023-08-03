<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\Firmas;

class IdentidadController extends Controller
{
    public function sendIdentidadPresentacion(Request $request)
    {
		

    	$client = new Client();
    	$html = '<div class="anverso">
                        <div class="anverso_1">
                            <img src="https://i.ibb.co/KyjB8mn/soc.jpg" alt="">
                        </div>
                        <div class="anverso_2">
                            <p>'.$request->departamento.'</p>
                        </div>
                    </div>';
		$css = ".anverso{
					padding: 100px 10px 100px 10px;
					font-size: 0;
					text-align: center;
					min-width: 424px;
				}
				.anverso_1{
					display: inline-block;
					width: 45%;
					border-right: 1px solid #004F89;
					padding: 0 10px;
				}
				.anverso_1 img{
					width: 100%;
				}
				.anverso_2{
					padding: 0 10px;
				    display: inline-block;
				    width: 45%;
				    vertical-align: middle;
				}
				.anverso_2 p{
					font-size: 1.8rem;
					font-weight: bold;
					color: #004F89;
					text-align: center;
					-ms-word-break: break-all;
					word-break: break-all;
					word-break: break-word;
					-webkit-hyphens: auto;
					-moz-hyphens: auto;
					-ms-hyphens: auto;
					hyphens: auto;
				}";
		
		$html_2 = '
		<div class="reverso">
			<div class="reverso_head">
				<h2>'.$request->nombre.'</h2>
				<p><span>'.$request->puesto.'</span></p>
			</div>
			<div class="reverso_1">
				<p>';
				if ($request->telefono != null) {
					$html_2 .= $request->telefono.'<br>';
				}else{}
				if ($request->celular != null) {
					$html_2 .= $request->celular.'<br>';
				}else{}
				if ($request->direccion != null) {
					$html_2 .= $request->direccion.'<br>';
				}else{}
				$html_2 .= $request->email.'<br>
					socasesores.com
				</p>
			</div>
			<div class="reverso_2">
			<img src="https://api.qrserver.com/v1/create-qr-code/?data='.$request->qr.'&amp;size=100x100" alt="" title="" />
			</div>
			<div class="reverso_footer">
				<ul>';
			if ($request->instagram != null) {
				$html_2 .= '<li><img src="https://i.ibb.co/DC9zkJ3/001-instagram.png" alt="">@-'.$request->instagram.'</li>';
			}else{}

			if ($request->facebook != null) {
				$html_2 .= '<li><img src="https://i.ibb.co/jh9LYSY/002-facebook.png" alt="">@-'.$request->facebook.'</li>';
			}else{}

			if ($request->twitter != null) {
				$html_2 .= '<li><img src="https://i.ibb.co/xmCSgSg/003-twitter.png" alt="">@-'.$request->twitter.'</li>';
			}else{}

			if ($request->linkedin != null) {
				$html_2 .= '<li><img src="https://i.ibb.co/T04YQ0M/004-linkedin.png" alt="">@-'.$request->linkedin.'</li>';
			}else{}
			$html_2 .='</ul>
			</div>
		</div>';
		$css_2 = "
		.reverso {
			padding: 30px 0px 0px 0px;
			font-size: 0;
			text-align: left;
			overflow: hidden;
			min-width: 424px;
		}
		.reverso_head h2 {
			color: #015694;
			padding: 0 20px 0 10px;
			font-size: 1.5rem;
			text-align: left;
			margin-bottom: 1rem;
			margin-top: 0;
		}
		
		.reverso_head p {
			color: ##40516F;
			font-weight: 100;
			font-size: 1rem;
			padding: 0 20px 0px 20px;
			text-align: left;
			margin-bottom: 1rem;
			margin-top: 0;
		}
		
		.reverso h2 {
			color: #015694;
			margin-bottom: 1rem;
		}
		
		.reverso_1 {
			display: inline-block;
			width: 60%;
			padding: 0 20px;
		}
		
		.reverso_1 p {
			font-size: 0.9rem;
			margin-bottom: 0;
			color: #40516F;
			font-weight: normal;
			text-align: left;
		}
		
		.reverso_2 img {
			width: 100%;
		}
		
		.reverso_2 {
			padding: 0 10px;
			display: inline-block;
			width: 20%;
			vertical-align: top;
		}
		.reverso_2 svg{
			width: 100%;
		}
		
		.reverso_footer {
			min-height: 35px;
			width: 100%;
			background: rgb(2, 88, 150);
			margin-top: 1rem;
			background: linear-gradient(90deg, rgba(2, 88, 150, 1) 0%, rgba(35, 166, 211, 1) 50%, rgba(74, 168, 82, 1) 100%);
		}
		.reverso_footer ul{
			list-style: none;
			padding-left: 0;
			text-align: center;
			margin-left: 0;
			padding-top: 7px;
		}
		.reverso_footer ul li{
			display: inline-block;
		}
		.reverso_footer ul li img{
			margin-right: 5px;
			width: 20px;
		}
		.reverso_footer ul li{
			font-size: .7rem;
			padding-right: 1rem;
			color: #fff;
		}";
		
		
		

		// // Retrieve your user_id and api_key from https://htmlcsstoimage.com/dashboard
		$res = $client->request('POST', 'https://hcti.io/v1/image', [
		   'auth' => ['6eefc015-07e6-43d0-9004-6ea368bfc0b2', '55a61981-6250-4d1c-bf7d-750f83b92a08'],
		   'form_params' => ['html' => $html, 'css' => $css]
		 ]);

		 $res_2 = $client->request('POST', 'https://hcti.io/v1/image', [
			'auth' => ['6eefc015-07e6-43d0-9004-6ea368bfc0b2', '55a61981-6250-4d1c-bf7d-750f83b92a08'],
			'form_params' => ['html' => $html_2, 'css' => $css_2]
		  ]);
		  $url_1 = strval($res->getBody());
		  $url_1_split = explode('{"url":"', $url_1);
		  $url_1_split = explode('"}', $url_1_split[1]);
		  $url_1_split = $url_1_split[0];

		  $url_2 = strval($res_2->getBody());
		  $url_2_split = explode('{"url":"', $url_2);
		  $url_2_split = explode('"}', $url_2_split[1]);
		  $url_2_split = $url_2_split[0];
		return view("identidad_presentacion",['url_1'=>$url_1_split, 'url_2'=>$url_2_split]);
    }
	public function sendIdentidadFirma(Request $request)
	{
		$client = new Client();
		$html_firma = '
		<div class="firma">
			<div class="firma_2">
				<img src="https://i.ibb.co/KyjB8mn/soc.jpg" alt="">
				<p>'.$request->departamento.'</p>
			</div>
			<div class="firma_1">
				<div class="firma_head">
					<h2>'.$request->nombre.'</h2>
					<p><span>'.$request->puesto.'</span></p>
				</div>
				<p>';
				if ($request->telefono != null) {
					$html_firma .= $request->telefono.'<br>';
				}else{}
				if ($request->celular != null) {
					$html_firma .= $request->celular.'<br>';
				}else{}
				if ($request->direccion != null) {
					$html_firma .= $request->direccion.'<br>';
				}else{}
				$html_firma .= $request->email.'<br>
					socasesores.com
				</p>
			</div>
			<div class="firma_footer">
				<ul>';
			if ($request->instagram != null) {
				$html_firma .= '<li><img src="https://i.ibb.co/DC9zkJ3/001-instagram.png" alt="">@-'.$request->instagram.'</li>';
			}else{}

			if ($request->facebook != null) {
				$html_firma .= '<li><img src="https://i.ibb.co/jh9LYSY/002-facebook.png" alt="">@-'.$request->facebook.'</li>';
			}else{}

			if ($request->twitter != null) {
				$html_firma .= '<li><img src="https://i.ibb.co/xmCSgSg/003-twitter.png" alt="">@-'.$request->twitter.'</li>';
			}else{}

			if ($request->linkedin != null) {
				$html_firma .= '<li><img src="https://i.ibb.co/T04YQ0M/004-linkedin.png" alt="">@-'.$request->linkedin.'</li>';
			}else{}
			$html_firma .='</ul>
			</div>
		</div>';
		$css_firma = '
		.firma {
			padding: 30px 0px 0px 0px;
			font-size: 0;
			text-align: left;
			overflow: hidden;
		}
		.firma_head{
			margin-bottom: 4rem
		}
		.firma_head h2 {
			color: #015694;
			font-size: 1.1rem;
			text-align: left;
			margin-bottom: 0!important;
			margin-top: 1.5rem;
		}
		
		.firma_head p {
			color: #40516F!important;
			font-weight: 100!important;
			font-size: 1rem!important;
			text-align: left!important;
			margin-bottom: 1rem!important;
			margin-top: 0;
		}
		
		.firma h2 {
			color: #015694;
			margin-bottom: 1rem;
		}
		
		.firma_1 {
			display: inline-block;
			width: 50%;
			padding: 0 20px;
		}
		
		.firma_1 p {
			font-size: 1rem;
			margin-bottom: 0;
			color: #4BC1E4;
			font-weight: bold;
			text-align: left;
		}
		
		.firma_2 img {
			width: 100%;
			padding-bottom: .5rem;
			border-bottom: #AEB3BF 3px solid;
		}
		
		.firma_2 {
			padding: 0 10px;
			display: inline-block;
			width: 38%;
			vertical-align: top;
		}
		.firma_2 p {
			font-size: 1.7rem;
			font-weight: bold;
			margin-bottom: 0;
			margin-top: 1rem;
			color: #004F89;
			text-align: center;
		}
		.firma_2 svg{
			width: 100%;
		}
		
		.firma_footer {
			min-height: 35px;
			width: 100%;
			background: rgb(2, 88, 150);
			margin-top: 1rem;
			background: linear-gradient(90deg, rgba(2, 88, 150, 1) 0%, rgba(35, 166, 211, 1) 50%, rgba(74, 168, 82, 1) 100%);
		}
		.firma_footer ul{
			list-style: none;
			padding-left: 0;
			text-align: center;
			margin-left: 0;
			padding-top: 7px;
		}
		.firma_footer ul li{
			display: inline-block;
		}
		.firma_footer ul li img{
			margin-right: 5px;
			width: 20px;
		}
		.firma_footer ul li{
			font-size: .7rem;
			padding-right: 1rem;
			color: #fff;
		}
		';
		$firma_r = $client->request('POST', 'https://hcti.io/v1/image', [
			'auth' => ['6eefc015-07e6-43d0-9004-6ea368bfc0b2', '55a61981-6250-4d1c-bf7d-750f83b92a08'],
			'form_params' => ['html' => $html_firma, 'css' => $css_firma]
		  ]);

		  $url_1 = strval($firma_r->getBody());
		  $url_1_split = explode('{"url":"', $url_1);
		  $url_1_split = explode('"}', $url_1_split[1]);
		  $url_1_split = $url_1_split[0];
		return view("identidad_firma",['url_1'=>$url_1_split]);
	}
	public function sendIdentidadTarjeta(Request $request){
		$firma = Firmas::insertGetId([
            'imagen' => $request->foto,
            'name' => $request->nombre,
            'puesto' => $request->puesto,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
        ]);
		return view("identidad_digital",['url'=>$firma]);
	}
	public function tarjetaDigital($id){
		$registro = Firmas::where('id',$id)->get();
        return view('identidad_tarjeta_firma',['registro' => $registro[0]]);
	}
	public function sendMail(Request $request){
		
		
            $file = $request->file('tarjeta');
            $file_name = $file->getClientOriginalName();
            $tarjeta = time().'_'.$file_name;

            // File upload location
            $location = 'archivos/tarjetas/';

            // Upload file
            $file->move(public_path().'/archivos/tarjetas/', $tarjeta);

            $file = $request->file('tarjeta_2');
            $file_name = $file->getClientOriginalName();
            $tarjeta_2 = time().'_'.$file_name;

            // File upload location
            $location = 'archivos/tarjetas/';

            // Upload file
            $file->move(public_path().'/archivos/tarjetas/', $tarjeta);  
        
        
            $file = $request->file('pago');
            $file_name = $file->getClientOriginalName();
            $pago = time().'_'.$file_name;

            // File upload location
            $location = 'archivos/tarjetas/';

            // Upload file
             $file->move(public_path().'/archivos/tarjetas/', $pago); 

          $email_to = "ingluisfelipe07@gmail.com";

        $email_subject = "Solicitud de tarjetas para impresion";

        $email_from = "webmaster@socasesores.com";

        $email_message = "Links de las tarjetas a imprimir y comprobante \n";

        $email_message .= "Tarjeta Anverso: https://socasesores.com/material/public/archivos/tarjetas/".$tarjeta."\n";
        $email_message .= "Tarjeta Reverso: https://socasesores.com/material/public/archivos/tarjetas/".$tarjeta_2."\n";
        $email_message .= "Comprobante de Pago: https://socasesores.com/material/public/archivos/tarjetas/".$pago."\n";

            $headers = 'From: '.$email_from."\r\n" .

        'Reply-To: '.$email_from."\r\n" .

        'X-Mailer: PHP/' . phpversion();

        mail($email_to, $email_subject, $email_message, $headers);

        return view("imprimir");
	}
}
