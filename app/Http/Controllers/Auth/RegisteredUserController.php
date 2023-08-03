<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User2;
use App\Models\User3;
use App\Models\Logs;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules;
use URL;
use DB;

use App\Exports\UsersExport2;
use Maatwebsite\Excel\Facades\Excel;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            $string = strtolower($string);
         
            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        }

        $url = clean($name_full);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        
        $user = User::create([
            'name' => $name_full,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sucursal' => $name_full,
            'active' => $request->active,
            'cotizador' => $request->cotizador,
            'calculadora' => $request->calculadora,
            'url' => $url,
            'telefono' => $request->telefono,
            'horario' => $request->horario,
            'direccion' => $request->direccion,
            'producto_1' => $request->producto_1,
            'producto_2' => $request->producto_2,
            'producto_3' => $request->producto_3,
            'producto_4' => $request->producto_4,
            'producto_5' => $request->producto_5,
            'producto_6' => $request->producto_6,
            'producto_7' => $request->producto_7,
            'producto_8' => $request->producto_8,
            'producto_9' => $request->producto_9,
            'producto_10' => $request->producto_10,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $id = Auth::id();

        return redirect('/dashboard/'.$id);
    }

    public function insert(Request $request)
    {
            function eliminar_acentos($cadena){
            
            //Reemplazamos la A y a
            $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
            );

            //Reemplazamos la E y e
            $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );

            //Reemplazamos la I y i
            $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );

            //Reemplazamos la O y o
            $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );

            //Reemplazamos la U y u
            $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );

            //Reemplazamos la N, n, C y c
            $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
            );
            
            return $cadena;
        }


        if (isset($request->name)) {
            $name_full = $request->name;
        }elseif(isset($request->sucursal)){
            $name_full = $request->sucursal;
        }


        $log = json_decode($request->getContent() , true);
        $log['oficinas'] = null;
        $log = json_encode($log);
       
        $registro_log = Logs::insertGetId([
                            'json' => $log
                        ]);

        if ($request->token == "&elYYxm$*wm4" || $request->token == "\u0026elYYxm$*wm4") {

            if (isset($request->id_sisec)) { 
                if ($request->tipo == "Hipotecario") {
                    $oficina = User::where("id_sisec", "=", $request->id_sisec)->first();
                    if ($oficina == null) {
                        $password = "soc_".rand();
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                           
                            $string = strtolower($string);
                        
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                        if ($name_full === "+ OPORTUNIDADES - Jalisco") {
                            $url = "+oportunidades";
                        }else{
                            $url = explode(" - ", $name_full);
                            $url = eliminar_acentos($url[0]);
                            $url = clean($url);
                            $url = explode(" - ", $url);
                            $url = $url[0];
                        }
                        
                        if (isset($request->id_sisec)) { 
                        }else{
                            return "Falta el ID Oficina";
                        }
                        if (isset($name_full)) { 
                        }else{
                            return "Falta el Nombre de la Sucursal";
                        }
                        
                        
                        
                        $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        if (isset($request->oficinas) && count($request->oficinas) > 0) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }

                        $productos_busqueda_1 = 0;
                        $productos_busqueda_2 = 0;
                        $productos_busqueda_3 = 0;
                        $productos_busqueda_4 = 0;
                        $productos_busqueda_total = 0;
                        $productos = array();


                        $productos_hipotecario = array();
                        $productos_empresarial = array();
                        $productos_seguros = array();
                        $productos_otros= array();
                        if (isset($request->productos)) { 
                            $productos_array = $request->productos;
                            foreach ($productos_array as $key => $value) {
                                array_push($productos, $value);

                                switch ($value) {
                                    case "Adquisición de terreno":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Liquidez":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Construcción":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Preventa":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Renovación / Remodelación":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Adquisición de vivienda":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Terreno + Construcción":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Mejora de hipoteca":
                                        array_push($productos_hipotecario, $value);
                                       $productos_busqueda_1 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Tarjeta de Crédito":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito como anticipo de ventas":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Hipotecario Empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito de Arrendamiento":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Revolvente":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Simple":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de auto":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de hogar":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Auto flotilla":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    case "Daños empresariales":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Adquisición de autos":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Sustitución de crédito de auto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Adquisición de moto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }
                            }
                            $productos = implode(",",$productos);
                        }else{
                            $productos = null;
                        }

                        if ($productos_busqueda_1 == 1) {
                            $productos_busqueda_total++;
                            $productos_hipotecario = implode(",",$productos_hipotecario);  
                        }else{
                            $productos_hipotecario = null;
                        }

                        if($productos_busqueda_2 == 1){
                            $productos_busqueda_total++;
                            $productos_empresarial = implode(",",$productos_empresarial);
                        
                        }else{
                            $productos_empresarial = null;
                        }

                        if($productos_busqueda_3 == 1){
                            $productos_busqueda_total++;
                            $productos_seguros = implode(",",$productos_seguros);
                            
                        }else{
                            $productos_seguros = null;
                        }

                        if($productos_busqueda_4 == 1){
                            $productos_busqueda_total++;
                            $productos_otros = implode(",",$productos_otros);
                            
                        }else{
                            $productos_otros = null;
                        }

                        

                        if ($productos_busqueda_total > 1) {
                            $tipo = "Venta Cruzada";
                        }else{
                            $tipo = $request->tipo;
                        }


                        $client = new Client();
                        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                        $res = json_decode($res->getBody());


                        $telefono = str_replace("–", "", $request->telefono);
                        
                        $registro_id = User::insertGetId([
                            'id_sisec' => $request->id_sisec,
                            'name' => $name_full,
                            'email' => $request->email,
                            'direccion' => $direccion,
                            'password' => Hash::make($password),
                            'password_save' => $password,
                            'sucursal' => $name_full,
                            'agente_soc' => $request->agente_soc,
                            'ciudad' => eliminar_acentos($request->municipio),
                            'estado' => eliminar_acentos($request->estado),
                            'active' => $request->active,
                            'cotizador' => $request->cotizador,
                            'calculadora' => $request->calculadora,
                            'tipo' => $tipo,
                            'horario' => $request->horario,
                            'certificacion' => $request->certificacion,
                            'lat' => $res->results[0]->geometry->location->lat,
                            'lng' => $res->results[0]->geometry->location->lng,
                            'url' => $url,
                            'url_clean' => $url,
                            'telefono' => $telefono,
                            'oficinas' => $oficinas,
                            'productos' => $productos,
                            'productos_hipotecario' => $productos_hipotecario,
                            'productos_empresarial' => $productos_empresarial,
                            'productos_seguros' => $productos_seguros,
                            'productos_otros' => $productos_otros

                        ]);

                        return "https://socasesores.com/micrositios/".$url;
                    }else{
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                         
                            $string = strtolower($string);
                         
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                        $user = $oficina;
                        if ($user === null) {
                            return "No se encontro registro";
                        }
                        $id = $user->id;
                        $url = $user->url;
                       
                        if (isset($name_full)) { 
                            if ($name_full === "+ OPORTUNIDADES - Jalisco") {
                                $url = "+oportunidades";
                                $user->name = $name_full;
                                $user->url = $url;
                            }else{
                                $url = explode(" - ", $name_full);
                                $url = eliminar_acentos($url[0]);
                                $url = clean($url);
                                $url = explode(" - ", $url);
                                $url = $url[0];
                                $user->name = $name_full;
                                $user->url = $url;
                            }
                            
                            
                        }else{
                            
                        }
                        if (isset($request->email)) { 
                            $user->email = $request->email;
                        }else{
                            
                        }
                        if (isset($request->telefono)) { 
                            $telefono = str_replace("–", "", $request->telefono);
                            $user->telefono = $telefono;
                        }else{
                            
                        }
                        if (isset($request->horario)) { 
                            $user->horario = $request->horario;
                        }else{
                            
                        }

                        

                        if (isset($request->calle)) {
                            $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                            $client = new Client();
                            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                            $res = json_decode($res->getBody());

                            $user->lat = $res->results[0]->geometry->location->lat;
                            $user->lng = $res->results[0]->geometry->location->lng;
                            $user->direccion = $direccion;
                        }else{

                        }

                  

                        if (isset($request->municipio)) { 
                            $user->ciudad = eliminar_acentos($request->municipio);
                        }else{
                            
                        }

                        if (isset($request->estado)) { 
                            $user->estado = eliminar_acentos($request->estado);
                        }else{
                            
                        }
                        

                        if (isset($request->logo)) { 
                            $user->logo = $request->logo;
                        }else{
                            
                        }

                        if (isset($request->active)) { 
                            $user->active = $request->active;
                        }else{
                            
                        }

                        if (isset($request->agente_soc)) { 
                            $user->agente_soc = $request->agente_soc;
                        }else{
                            
                        }

                        if (isset($request->cotizador)) { 
                            $user->cotizador = $request->cotizador;
                        }else{
                            
                        }

                        if (isset($request->calculadora)) { 
                            $user->calculadora = $request->calculadora;
                        }else{
                            
                        }
                        if (isset($request->whatsapp)) { 
                            $user->whatsapp = $request->whatsapp;
                        }else{
                            
                        }
                        if (isset($request->description)) { 
                            $user->description = $request->description;
                        }else{
                            
                        }
                     
                        if (isset($request->twitter)) { 
                            $user->twitter = $request->twitter;
                        }else{
                            
                        }
                        if (isset($request->facebook)) { 
                            $user->facebook = $request->facebook;
                        }else{
                            
                        }
                        if (isset($request->youtube)) { 
                            $user->youtube = $request->youtube;
                        }else{
                            
                        }
                        if (isset($request->tipo)) { 
                            $user->tipo = $request->tipo;
                        }else{
                            
                        }
                        if (isset($request->linkedin)) { 
                            $user->linkedin = $request->linkedin;
                        }else{
                            
                        }
                        if (isset($request->instagram)) { 
                            $user->instagram = $request->instagram;
                        }else{
                            
                        }
                        if (isset($request->certificacion)) { 
                            $user->certificacion = $request->certificacion;
                        }else{
                            
                        }



                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }


                        $productos_busqueda_1 = 0;
                        $productos_busqueda_2 = 0;
                        $productos_busqueda_3 = 0;
                        $productos_busqueda_4 = 0;
                        $productos_busqueda_total = 0;
                        $productos = array();


                        $productos_hipotecario = array();
                        $productos_empresarial = array();
                        $productos_seguros = array();
                        $productos_otros= array();

                        if (isset($request->productos)) { 
                            $productos_array = $request->productos;
                            foreach ($productos_array as $key => $value) {
                                array_push($productos, $value);

                                switch ($value) {
                                    case "Adquisición de terreno":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Liquidez":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Construcción":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Preventa":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Renovación / Remodelación":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Adquisición de vivienda":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Terreno + Construcción":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Mejora de hipoteca":
                                        array_push($productos_hipotecario, $value);
                                       $productos_busqueda_1 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Tarjeta de Crédito":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito como anticipo de ventas":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Hipotecario Empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito arrendamiento":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Revolvente":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Simple":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de auto":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de hogar":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Auto flotilla":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    case "Daños empresariales":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Adquisición de autos":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Sustitución de crédito de auto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Adquisición de moto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }
                            }
                            $productos = implode(",",$productos);
                            $user->productos = $productos;
                        }else{
                            $productos = null;
                        }

                        if ($productos_busqueda_1 == 1) {
                            $productos_busqueda_total++;
                            $productos_hipotecario = implode(",",$productos_hipotecario);
                            $user->productos_hipotecario = $productos_hipotecario;

                        }else{
                            $productos_hipotecario = null;
                        }

                        if($productos_busqueda_2 == 1){
                            $productos_busqueda_total++;
                            $productos_empresarial = implode(",",$productos_empresarial);
                            $user->productos_empresarial = $productos_empresarial;
                        
                        }else{
                            $productos_empresarial = null;
                        }

                        if($productos_busqueda_3 == 1){
                            $productos_busqueda_total++;
                            $productos_seguros = implode(",",$productos_seguros);
                            $user->productos_seguros = $productos_seguros;
                            
                        }else{
                            $productos_seguros = null;
                        }

                        if($productos_busqueda_4 == 1){
                            $productos_busqueda_total++;
                            $productos_otros = implode(",",$productos_otros);
                            $user->productos_otros = $productos_otros;
                            
                        }else{
                            $productos_otros = null;
                        }

                        

                        if ($productos_busqueda_total > 1) {
                            $tipo = "Venta Cruzada";
                            $user->tipo = $tipo;
                        }else{
                            $tipo = $request->tipo;
                            $user->tipo = $tipo;
                        }                        

                        $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        
                        if (isset($request->oficinas)) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }
                
                        $user->save();
                
                        return "https://socasesores.com/micrositios/".$url;
                    }
                }elseif($request->tipo == "PYME"){
                    $user  = User2::where("id_sisec", "=", $request->id_sisec)->first();
                    if ($user == null) {
                        $password = "soc_".rand();
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                       // Removes special chars.
                            $string = strtolower($string);
                        
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }

                        $url = explode(" - ", $name_full);
                        $url = eliminar_acentos($url[0]);
                        $url = clean($url);
                        $url = explode(" - ", $url);
                        $url = $url[0];
                        if (isset($request->id_sisec)) { 
                        }else{
                            return "Falta el ID Oficina";
                        }
                        if (isset($name_full)) { 
                        }else{
                            return "Falta el Nombre de la Sucursal";
                        }
                        
                        
                        if (isset($request->telefono)) { 

                        }else{
                            return "Falta el Teléfono";
                        }
                        $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        if (isset($request->oficinas) && count($request->oficinas) > 0) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }

                        $productos_busqueda_1 = 0;
                        $productos_busqueda_2 = 0;
                        $productos_busqueda_3 = 0;
                        $productos_busqueda_4 = 0;
                        $productos_busqueda_total = 0;
                        $productos = array();


                        $productos_hipotecario = array();
                        $productos_empresarial = array();
                        $productos_seguros = array();
                        $productos_otros= array();
                        if (isset($request->productos)) { 
                            $productos_array = $request->productos;
                            foreach ($productos_array as $key => $value) {
                                array_push($productos, $value);

                                switch ($value) {
                                    case "Adquisición de terreno":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Liquidez":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Construcción":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Preventa":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Renovación / Remodelación":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Adquisición de vivienda":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Terreno + Construcción":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Mejora de hipoteca":
                                        array_push($productos_hipotecario, $value);
                                       $productos_busqueda_1 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Tarjeta de Crédito":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito como anticipo de ventas":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Hipotecario Empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito arrendamiento":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Revolvente":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Simple":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de auto":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de hogar":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Auto flotilla":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    case "Daños empresariales":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Adquisición de autos":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Sustitución de crédito de auto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Adquisición de moto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }
                            }
                            $productos = implode(",",$productos);
                        }else{
                            $productos = null;
                        }

                        if ($productos_busqueda_1 == 1) {
                            $productos_busqueda_total++;
                            $productos_hipotecario = implode(",",$productos_hipotecario);  
                        }else{
                            $productos_hipotecario = null;
                        }

                        if($productos_busqueda_2 == 1){
                            $productos_busqueda_total++;
                            $productos_empresarial = implode(",",$productos_empresarial);
                        
                        }else{
                            $productos_empresarial = null;
                        }

                        if($productos_busqueda_3 == 1){
                            $productos_busqueda_total++;
                            $productos_seguros = implode(",",$productos_seguros);
                            
                        }else{
                            $productos_seguros = null;
                        }

                        if($productos_busqueda_4 == 1){
                            $productos_busqueda_total++;
                            $productos_otros = implode(",",$productos_otros);
                            
                        }else{
                            $productos_otros = null;
                        }

                        

                        if ($productos_busqueda_total > 1) {
                            $tipo = "Venta Cruzada";
                        }else{
                            $tipo = $request->tipo;
                        }

                        $client = new Client();
                        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                        $res = json_decode($res->getBody());
                        $telefono = str_replace("–", "", $request->telefono);
                        $registro_id = DB::connection('empresas')->table('users')->insertGetId([
                            'id_sisec' => $request->id_sisec,
                            'name' => $name_full,
                            'email' => $request->email,
                            'direccion' => $direccion,
                            'tipo'=> $tipo,
                            'password' => Hash::make($password),
                            'password_save' => $password,
                            'ciudad' => eliminar_acentos($request->municipio),
                            'estado' => eliminar_acentos($request->estado),
                            'sucursal' => $name_full,
                            'horario' => $request->horario,
                            'certificacion' => $request->certificacion,
                            'calculadora' => $request->calculadora,
                            'lat' => $res->results[0]->geometry->location->lat,
                            'lng' => $res->results[0]->geometry->location->lng,
                            'url' => $url,
                            'url_clean' => $url,
                            'telefono' => $telefono,
                            'productos' => $productos,
                            'productos_hipotecario' => $productos_hipotecario,
                            'productos_empresarial' => $productos_empresarial,
                            'productos_seguros' => $productos_seguros,
                            'productos_otros' => $productos_otros

                        ]);

                        return "https://socasesores.com/micrositios-empresarial/".$url;
                    }else{
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                             // Removes special chars.
                            $string = strtolower($string);
                         
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                      
                        if ($user === null) {
                            return "No se encontro registro";
                        }
                        $id = $user->id;
                        $url = $user->url;
                       
                        if (isset($name_full)) { 

                            $url = explode(" - ", $name_full);
                            $url = eliminar_acentos($url[0]);
                            $url = clean($url);
                            $url = explode(" - ", $url);
                            $url = $url[0];
                            $user->name = $name_full;
                            $user->url = $url;
                        }else{
                            
                        }
                        if (isset($request->email)) { 
                            $user->email = $request->email;
                        }else{
                            
                        }
                        if (isset($request->telefono)) { 
                            $telefono = str_replace("–", "", $request->telefono);
                            $user->telefono = $telefono;
                        }else{
                            
                        }
                        if (isset($request->horario)) { 
                            $user->horario = $request->horario;
                        }else{
                            
                        }

                        

                        if (isset($request->calle)) {
                            $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                            $client = new Client();
                            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                            $res = json_decode($res->getBody());

                            $user->lat = $res->results[0]->geometry->location->lat;
                            $user->lng = $res->results[0]->geometry->location->lng;
                            $user->direccion = $direccion;
                        }else{

                        }


                        if (isset($request->municipio)) { 
                            $user->ciudad = eliminar_acentos($request->municipio);
                        }else{
                            
                        }

                        if (isset($request->estado)) { 
                            $user->estado = eliminar_acentos($request->estado);
                        }else{
                            
                        }
                        

                        if (isset($request->logo)) { 
                            $user->logo = $request->logo;
                        }else{
                            
                        }

                        if (isset($request->active)) { 
                            $user->active = $request->active;
                        }else{
                            
                        }

                        if (isset($request->agente_soc)) { 
                            $user->agente_soc = $request->agente_soc;
                        }else{
                            
                        }

                        if (isset($request->cotizador)) { 
                            $user->cotizador = $request->cotizador;
                        }else{
                            
                        }

                        if (isset($request->calculadora)) { 
                            $user->calculadora = $request->calculadora;
                        }else{
                            
                        }
                        if (isset($request->whatsapp)) { 
                            $user->whatsapp = $request->whatsapp;
                        }else{
                            
                        }
                        if (isset($request->description)) { 
                            $user->description = $request->description;
                        }else{
                            
                        }
                     
                        if (isset($request->twitter)) { 
                            $user->twitter = $request->twitter;
                        }else{
                            
                        }
                        if (isset($request->facebook)) { 
                            $user->facebook = $request->facebook;
                        }else{
                            
                        }

                        if (isset($request->linkedin)) { 
                            $user->linkedin = $request->linkedin;
                        }else{
                            
                        }
                        if (isset($request->instagram)) { 
                            $user->instagram = $request->instagram;
                        }else{
                            
                        }
                        if (isset($request->certificacion)) { 
                            $user->certificacion = $request->certificacion;
                        }else{
                            
                        }



                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }

                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }


                        $productos_busqueda_1 = 0;
                        $productos_busqueda_2 = 0;
                        $productos_busqueda_3 = 0;
                        $productos_busqueda_4 = 0;
                        $productos_busqueda_total = 0;
                        $productos = array();


                        $productos_hipotecario = array();
                        $productos_empresarial = array();
                        $productos_seguros = array();
                        $productos_otros= array();

                        if (isset($request->productos)) { 
                            $productos_array = $request->productos;
                            foreach ($productos_array as $key => $value) {
                                array_push($productos, $value);

                                switch ($value) {
                                    case "Adquisición de terreno":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Liquidez":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Construcción":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Preventa":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Renovación / Remodelación":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Adquisición de vivienda":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Terreno + Construcción":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Mejora de hipoteca":
                                        array_push($productos_hipotecario, $value);
                                       $productos_busqueda_1 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Tarjeta de Crédito":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito como anticipo de ventas":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Hipotecario Empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito arrendamiento":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Revolvente":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Simple":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Seguro de auto":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de hogar":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Auto flotilla":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Daños empresariales":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Adquisición de autos":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Sustitución de crédito de auto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Adquisición de moto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }
                            }
                            $productos = implode(",",$productos);
                            $user->productos = $productos;
                        }else{
                            $productos = null;
                        }

                        if ($productos_busqueda_1 == 1) {
                            $productos_busqueda_total++;
                            $productos_hipotecario = implode(",",$productos_hipotecario);
                            $user->productos_hipotecario = $productos_hipotecario;

                        }else{
                            $productos_hipotecario = null;
                        }

                        if($productos_busqueda_2 == 1){
                            $productos_busqueda_total++;
                            $productos_empresarial = implode(",",$productos_empresarial);
                            $user->productos_empresarial = $productos_empresarial;
                        
                        }else{
                            $productos_empresarial = null;
                        }

                        if($productos_busqueda_3 == 1){
                            $productos_busqueda_total++;
                            $productos_seguros = implode(",",$productos_seguros);
                            $user->productos_seguros = $productos_seguros;
                            
                        }else{
                            $productos_seguros = null;
                        }

                        if($productos_busqueda_4 == 1){
                            $productos_busqueda_total++;
                            $productos_otros = implode(",",$productos_otros);
                            $user->productos_otros = $productos_otros;
                            
                        }else{
                            $productos_otros = null;
                        }

                        

                        if ($productos_busqueda_total > 1) {
                            $tipo = "Venta Cruzada";
                            $user->tipo = $tipo;
                        }else{
                            $tipo = $request->tipo;
                            $user->tipo = $tipo;
                        }                

                        $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        
                        if (isset($request->oficinas)) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }
                
                        $user->save();
                
                        return "https://socasesores.com/micrositios-empresarial/".$url;
                    }

                }elseif($request->tipo == "Seguros"){
                    $empresas  = User3::where("id_sisec", "=", $request->id_sisec)->first();
                    if ($empresas == null) {
                        $password = "soc_".rand();
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                            $string = strtolower($string);
                        
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }

                        $url = explode(" - ", $name_full);
                        $url = eliminar_acentos($url[0]);
                            $url = clean($url);
                            $url = explode(" - ", $url);
                            $url = $url[0];

                        if (isset($request->id_sisec)) { 
                        }else{
                            return "Falta el ID Oficina";
                        }
                        if (isset($name_full)) { 
                        }else{
                            return "Falta el Nombre de la Sucursal";
                        }
                        
                        
                        if (isset($request->telefono)) { 

                        }else{
                            return "Falta el Teléfono";
                        }
                       $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        if (isset($request->oficinas) && count($request->oficinas) > 0) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }

                        $productos_busqueda_1 = 0;
                        $productos_busqueda_2 = 0;
                        $productos_busqueda_3 = 0;
                        $productos_busqueda_4 = 0;
                        $productos_busqueda_total = 0;
                        $productos = array();


                        $productos_hipotecario = array();
                        $productos_empresarial = array();
                        $productos_seguros = array();
                        $productos_otros= array();
                        if (isset($request->productos)) { 
                            $productos_array = $request->productos;
                            foreach ($productos_array as $key => $value) {
                                array_push($productos, $value);

                                switch ($value) {
                                    case "Adquisición de terreno":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Liquidez":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Construcción":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Preventa":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Renovación / Remodelación":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Adquisición de vivienda":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Terreno + Construcción":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Mejora de hipoteca":
                                        array_push($productos_hipotecario, $value);
                                       $productos_busqueda_1 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Tarjeta de Crédito":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito como anticipo de ventas":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Hipotecario Empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito de Arrendamiento":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Revolvente":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Simple":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de auto":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de hogar":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Auto flotilla":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    case "Daños empresariales":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Adquisición de autos":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Sustitución de crédito de auto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Adquisición de moto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }
                            }
                            $productos = implode(",",$productos);
                        }else{
                            $productos = null;
                        }

                        if ($productos_busqueda_1 == 1) {
                            $productos_busqueda_total++;
                            $productos_hipotecario = implode(",",$productos_hipotecario);  
                        }else{
                            $productos_hipotecario = null;
                        }

                        if($productos_busqueda_2 == 1){
                            $productos_busqueda_total++;
                            $productos_empresarial = implode(",",$productos_empresarial);
                        
                        }else{
                            $productos_empresarial = null;
                        }

                        if($productos_busqueda_3 == 1){
                            $productos_busqueda_total++;
                            $productos_seguros = implode(",",$productos_seguros);
                            
                        }else{
                            $productos_seguros = null;
                        }

                        if($productos_busqueda_4 == 1){
                            $productos_busqueda_total++;
                            $productos_otros = implode(",",$productos_otros);
                            
                        }else{
                            $productos_otros = null;
                        }

                        

                        if ($productos_busqueda_total > 1) {
                            $tipo = "Venta Cruzada";
                        }else{
                            $tipo = $request->tipo;
                        }

                        $client = new Client();
                        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                        $res = json_decode($res->getBody());
                        $telefono = str_replace("–", "", $request->telefono);
                        $registro_id = DB::connection('seguros')->table('users')->insertGetId([
                            'id_sisec' => $request->id_sisec,
                            'name' => $name_full,
                            'email' => $request->email,
                            'direccion' => $direccion,
                            'ciudad' => eliminar_acentos($request->municipio),
                            'estado' => eliminar_acentos($request->estado),
                            'password' => Hash::make($password),
                            'password_save' => $password,
                            'sucursal' => $name_full,
                            'horario' => $request->horario,
                            'agente_soc' => $request->agente_soc,
                            'certificacion' => $request->certificacion,
                            'lat' => $res->results[0]->geometry->location->lat,
                            'lng' => $res->results[0]->geometry->location->lng,
                            'url' => $url,
                            'url_clean' => $url,
                            'telefono' => $telefono,
                            'productos' => $productos,
                            'productos_hipotecario' => $productos_hipotecario,
                            'productos_empresarial' => $productos_empresarial,
                            'productos_seguros' => $productos_seguros,
                            'productos_otros' => $productos_otros

                        ]);

                        return "https://socasesores.com/micrositios-seguros/".$url;
                    }else{
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                            $string = strtolower($string);
                         
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                        $user = $empresas;
                        if ($user === null) {
                            return "No se encontro registro";
                        }
                        $id = $user->id;
                        $url = $user->url;
                       
                        if (isset($name_full)) { 

                            $url = explode(" - ", $name_full);
                        $url = eliminar_acentos($url[0]);
                            $url = clean($url);
                            $url = explode(" - ", $url);
                            $url = $url[0];
                            $user->name = $name_full;
                            $user->url = $url;
                        }else{
                            
                        }
                        if (isset($request->email)) { 
                            $user->email = $request->email;
                        }else{
                            
                        }
                        if (isset($request->telefono)) { 
                            $telefono = str_replace("–", "", $request->telefono);
                            $user->telefono = $telefono;
                        }else{
                            
                        }
                        if (isset($request->horario)) { 
                            $user->horario = $request->horario;
                        }else{
                            
                        }

                        

                        if (isset($request->calle)) {
                            $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                            $client = new Client();
                            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                            $res = json_decode($res->getBody());

                            $user->lat = $res->results[0]->geometry->location->lat;
                            $user->lng = $res->results[0]->geometry->location->lng;
                            $user->direccion = $direccion;
                        }else{

                        }


                        if (isset($request->municipio)) { 
                            $user->ciudad = eliminar_acentos($request->municipio);
                        }else{
                            
                        }

                        if (isset($request->estado)) { 
                            $user->estado = eliminar_acentos($request->estado);
                        }else{
                            
                        }
                        

                        if (isset($request->logo)) { 
                            $user->logo = $request->logo;
                        }else{
                            
                        }

                        if (isset($request->active)) { 
                            $user->active = $request->active;
                        }else{
                            
                        }

                        if (isset($request->agente_soc)) { 
                            $user->agente_soc = $request->agente_soc;
                        }else{
                            
                        }

                        if (isset($request->cotizador)) { 
                            $user->cotizador = $request->cotizador;
                        }else{
                            
                        }

                        if (isset($request->calculadora)) { 
                            $user->calculadora = $request->calculadora;
                        }else{
                            
                        }
                        if (isset($request->whatsapp)) { 
                            $user->whatsapp = $request->whatsapp;
                        }else{
                            
                        }
                        if (isset($request->description)) { 
                            $user->description = $request->description;
                        }else{
                            
                        }
                     
                        if (isset($request->twitter)) { 
                            $user->twitter = $request->twitter;
                        }else{
                            
                        }
                        if (isset($request->facebook)) { 
                            $user->facebook = $request->facebook;
                        }else{
                            
                        }
        
                        if (isset($request->linkedin)) { 
                            $user->linkedin = $request->linkedin;
                        }else{
                            
                        }
                        if (isset($request->instagram)) { 
                            $user->instagram = $request->instagram;
                        }else{
                            
                        }
                        if (isset($request->certificacion)) { 
                            $user->certificacion = $request->certificacion;
                        }else{
                            
                        }



                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }

                        $productos_busqueda_1 = 0;
                        $productos_busqueda_2 = 0;
                        $productos_busqueda_3 = 0;
                        $productos_busqueda_4 = 0;
                        $productos_busqueda_total = 0;
                        $productos = array();


                        $productos_hipotecario = array();
                        $productos_empresarial = array();
                        $productos_seguros = array();
                        $productos_otros= array();

                        if (isset($request->productos)) { 
                            $productos_array = $request->productos;
                            foreach ($productos_array as $key => $value) {
                                array_push($productos, $value);

                                switch ($value) {
                                    case "Adquisición de terreno":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Liquidez":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Construcción":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Preventa":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Renovación / Remodelación":
                                        $productos_busqueda_1 = 1;
                                        array_push($productos_hipotecario, $value);
                                        break;
                                    case "Adquisición de vivienda":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Terreno + Construcción":
                                        array_push($productos_hipotecario, $value);
                                        $productos_busqueda_1 = 1;
                                        break;
                                    case "Mejora de hipoteca":
                                        array_push($productos_hipotecario, $value);
                                       $productos_busqueda_1 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Tarjeta de Crédito":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito como anticipo de ventas":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Hipotecario Empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito arrendamiento":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Revolvente":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito Simple":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    case "Crédito empresarial":
                                        array_push($productos_empresarial, $value);
                                        $productos_busqueda_2 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de auto":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de vida":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Seguro de hogar":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Auto flotilla":
                                        array_push($productos_seguros, $value);
                                        $productos_busqueda_3 = 1;
                                        break;
                                    case "Gastos médicos mayores":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    case "Daños empresariales":
                                        array_push($productos_seguros, $value);
                                       $productos_busqueda_3 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }

                                switch ($value) {
                                    case "Adquisición de autos":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Sustitución de crédito de auto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    case "Adquisición de moto":
                                        array_push($productos_otros, $value);
                                        $productos_busqueda_4 = 1;
                                        break;
                                    default:
                                        
                                        break;
                                }
                            }
                            $productos = implode(",",$productos);
                            $user->productos = $productos;
                        }else{
                            $productos = null;
                        }

                        if ($productos_busqueda_1 == 1) {
                            $productos_busqueda_total++;
                            $productos_hipotecario = implode(",",$productos_hipotecario);
                            $user->productos_hipotecario = $productos_hipotecario;

                        }else{
                            $productos_hipotecario = null;
                        }

                        if($productos_busqueda_2 == 1){
                            $productos_busqueda_total++;
                            $productos_empresarial = implode(",",$productos_empresarial);
                            $user->productos_empresarial = $productos_empresarial;
                        
                        }else{
                            $productos_empresarial = null;
                        }

                        if($productos_busqueda_3 == 1){
                            $productos_busqueda_total++;
                            $productos_seguros = implode(",",$productos_seguros);
                            $user->productos_seguros = $productos_seguros;
                            
                        }else{
                            $productos_seguros = null;
                        }

                        if($productos_busqueda_4 == 1){
                            $productos_busqueda_total++;
                            $productos_otros = implode(",",$productos_otros);
                            $user->productos_otros = $productos_otros;
                            
                        }else{
                            $productos_otros = null;
                        }

                        

                        if ($productos_busqueda_total > 1) {
                            $tipo = "Venta Cruzada";
                            $user->tipo = $tipo;
                        }else{
                            $tipo = $request->tipo;
                            $user->tipo = $tipo;
                        }    

                        $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        
                        if (isset($request->oficinas)) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }
                
                        $user->save();
                
                        return "https://socasesores.com/micrositios-seguros/".$url;
                    }

                }else{
                    $oficina = User::where("id_sisec", "=", $request->id_sisec)->first();
                    if ($oficina == null) {
                        
                    }else{
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                           
                            $string = strtolower($string);
                         
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                        $user = $oficina;
                        if ($user === null) {
                            return "No se encontro registro";
                        }
                        $id = $user->id;
                        if ($user->url_clean == null) {
                            $url = $user->url;
                        }else{
                            $url = $user->url_clean;
                        }
                       
                        if (isset($name_full)) { 
                            if ($name_full === "+ OPORTUNIDADES - Jalisco") {
                                $url = "+oportunidades";
                                $user->name = $name_full;
                                $user->url = $url;
                            }else{
                                $url = explode(" - ", $name_full);
                                $url = eliminar_acentos($url[0]);
                                $url = clean($url);
                                $url = explode(" - ", $url);
                                $url = $url[0];
                                $user->name = $name_full;
                                $user->url = $url;
                            }
                            
                            
                        }else{
                            
                        }
                        if (isset($request->email)) { 
                            $user->email = $request->email;
                        }else{
                            
                        }
                        if (isset($request->telefono)) { 
                            $telefono = str_replace("–", "", $request->telefono);
                            $user->telefono = $telefono;
                        }else{
                            
                        }
                        if (isset($request->horario)) { 
                            $user->horario = $request->horario;
                        }else{
                            
                        }

                        

                        if (isset($request->calle)) {
                            $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                            $client = new Client();
                            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                            $res = json_decode($res->getBody());

                            $user->lat = $res->results[0]->geometry->location->lat;
                            $user->lng = $res->results[0]->geometry->location->lng;
                            $user->direccion = $direccion;
                        }else{

                        }

                  

                        if (isset($request->municipio)) { 
                            $user->ciudad = eliminar_acentos($request->municipio);
                        }else{
                            
                        }

                        if (isset($request->estado)) { 
                            $user->estado = eliminar_acentos($request->estado);
                        }else{
                            
                        }
                        

                        if (isset($request->logo)) { 
                            $user->logo = $request->logo;
                        }else{
                            
                        }

                        if (isset($request->active)) { 
                            $user->active = $request->active;
                        }else{
                            
                        }

                        if (isset($request->agente_soc)) { 
                            $user->agente_soc = $request->agente_soc;
                        }else{
                            
                        }

                        if (isset($request->cotizador)) { 
                            $user->cotizador = $request->cotizador;
                        }else{
                            
                        }

                        if (isset($request->calculadora)) { 
                            $user->calculadora = $request->calculadora;
                        }else{
                            
                        }
                        if (isset($request->whatsapp)) { 
                            $user->whatsapp = $request->whatsapp;
                        }else{
                            
                        }
                        if (isset($request->description)) { 
                            $user->description = $request->description;
                        }else{
                            
                        }
                     
                        if (isset($request->twitter)) { 
                            $user->twitter = $request->twitter;
                        }else{
                            
                        }
                        if (isset($request->facebook)) { 
                            $user->facebook = $request->facebook;
                        }else{
                            
                        }
                        if (isset($request->youtube)) { 
                            $user->youtube = $request->youtube;
                        }else{
                            
                        }
                        if (isset($request->tipo)) { 
                            $user->tipo = $request->tipo;
                        }else{
                            
                        }
                        if (isset($request->linkedin)) { 
                            $user->linkedin = $request->linkedin;
                        }else{
                            
                        }
                        if (isset($request->instagram)) { 
                            $user->instagram = $request->instagram;
                        }else{
                            
                        }
                        if (isset($request->certificacion)) { 
                            $user->certificacion = $request->certificacion;
                        }else{
                            
                        }



                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }

                        $productos = array();
                        if (isset($request->productos) && count($request->productos) > 0) { 
                            foreach ($request->productos as $key => $value) {
                                array_push($productos, $value);
                            }
                            $productos = implode(",", $productos);
                            $user->productos = $productos;
                        }else{
                            
                        }

                        $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        
                        if (isset($request->oficinas)) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }
                
                        $user->save();
                
                        return "https://socasesores.com/micrositios/".$url;
                     }

                    $user  = User2::where("id_sisec", "=", $request->id_sisec)->first();
                    if ($user == null) {
                        
                    }else{
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                        // Removes special chars.
                            $string = strtolower($string);
                         
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                      
                        if ($user === null) {
                            return "No se encontro registro";
                        }
                        $id = $user->id;
                        if ($user->url_clean == null) {
                            $url = $user->url;
                        }else{
                            $url = $user->url_clean;
                        }
                       
                        if (isset($name_full)) { 
                            $url = explode(" - ", $name_full);
                            $url = eliminar_acentos($url[0]);
                            $url = clean($url);
                            $url = explode("- ", $url);
                            $url = $url[0];
                            $user->name = $name_full;
                            $user->url_clean = $url;
                        }else{
                            
                        }
                        if (isset($request->email)) { 
                            $user->email = $request->email;
                        }else{
                            
                        }
                        if (isset($request->telefono)) { 
                            $telefono = str_replace("–", "", $request->telefono);
                            $user->telefono = $telefono;
                        }else{
                            
                        }
                        if (isset($request->horario)) { 
                            $user->horario = $request->horario;
                        }else{
                            
                        }

                        

                        if (isset($request->calle)) {
                            $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                            $client = new Client();
                            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                            $res = json_decode($res->getBody());

                            $user->lat = $res->results[0]->geometry->location->lat;
                            $user->lng = $res->results[0]->geometry->location->lng;
                            $user->direccion = $direccion;
                        }else{

                        }


                        if (isset($request->municipio)) { 
                            $user->ciudad = eliminar_acentos($request->municipio);
                        }else{
                            
                        }

                        if (isset($request->estado)) { 
                            $user->estado = eliminar_acentos($request->estado);
                        }else{
                            
                        }
                        

                        if (isset($request->logo)) { 
                            $user->logo = $request->logo;
                        }else{
                            
                        }

                        if (isset($request->active)) { 
                            $user->active = $request->active;
                        }else{
                            
                        }

                        if (isset($request->agente_soc)) { 
                            $user->agente_soc = $request->agente_soc;
                        }else{
                            
                        }

                        if (isset($request->cotizador)) { 
                            $user->cotizador = $request->cotizador;
                        }else{
                            
                        }

                        if (isset($request->calculadora)) { 
                            $user->calculadora = $request->calculadora;
                        }else{
                            
                        }
                        if (isset($request->whatsapp)) { 
                            $user->whatsapp = $request->whatsapp;
                        }else{
                            
                        }
                        if (isset($request->description)) { 
                            $user->description = $request->description;
                        }else{
                            
                        }
                     
                        if (isset($request->twitter)) { 
                            $user->twitter = $request->twitter;
                        }else{
                            
                        }
                        if (isset($request->facebook)) { 
                            $user->facebook = $request->facebook;
                        }else{
                            
                        }

                        if (isset($request->linkedin)) { 
                            $user->linkedin = $request->linkedin;
                        }else{
                            
                        }
                        if (isset($request->instagram)) { 
                            $user->instagram = $request->instagram;
                        }else{
                            
                        }
                        if (isset($request->certificacion)) { 
                            $user->certificacion = $request->certificacion;
                        }else{
                            
                        }



                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }

                        $productos = array();
                        if (isset($request->productos)) { 
                            foreach ($request->productos as $key => $value) {
                                array_push($productos, $value);
                            }
                            $productos = implode(",", $productos);
                            $user->productos = $productos;
                        }else{
                            
                        }

                        $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        
                        if (isset($request->oficinas)) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }
                
                        $user->save();
                
                        return "https://socasesores.com/micrositios-empresarial/".$url;
                     }

                    $empresas  = User3::where("id_sisec", "=", $request->id_sisec)->first();
                    if ($empresas == null) {
                        
                    }else{
                        function clean($string) {
                            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                           // Removes special chars.
                            $string = strtolower($string);
                         
                            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
                        }
                        $user = $empresas;
                        if ($user === null) {
                            return "No se encontro registro";
                        }
                        $id = $user->id;
                        if ($user->url_clean == null) {
                            $url = $user->url;
                        }else{
                            $url = $user->url_clean;
                        }
                       
                        if (isset($name_full)) { 

                            $url = explode(" - ", $name_full);
                            $url = eliminar_acentos($url[0]);
                            $url = clean($url);
                            $url = explode(" - ", $url);
                            $url = $url[0];
                            $user->name = $name_full;
                            $user->url_clean = $url;
                        }else{
                            
                        }
                        if (isset($request->email)) { 
                            $user->email = $request->email;
                        }else{
                            
                        }
                        if (isset($request->telefono)) { 
                            $telefono = str_replace("–", "", $request->telefono);
                            $user->telefono = $telefono;
                        }else{
                            
                        }
                        if (isset($request->horario)) { 
                            $user->horario = $request->horario;
                        }else{
                            
                        }

                        

                        if (isset($request->calle)) {
                            $direccion = $request->calle." ".$request->n_exterior." ".$request->n_interior." ".$request->colonia." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                            $client = new Client();
                            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                            $res = json_decode($res->getBody());

                            $user->lat = $res->results[0]->geometry->location->lat;
                            $user->lng = $res->results[0]->geometry->location->lng;
                            $user->direccion = $direccion;
                        }else{

                        }


                        if (isset($request->municipio)) { 
                            $user->ciudad = eliminar_acentos($request->municipio);
                        }else{
                            
                        }

                        if (isset($request->estado)) { 
                            $user->estado = eliminar_acentos($request->estado);
                        }else{
                            
                        }
                        

                        if (isset($request->logo)) { 
                            $user->logo = $request->logo;
                        }else{
                            
                        }

                        if (isset($request->active)) { 
                            $user->active = $request->active;
                        }else{
                            
                        }

                        if (isset($request->agente_soc)) { 
                            $user->agente_soc = $request->agente_soc;
                        }else{
                            
                        }

                        if (isset($request->cotizador)) { 
                            $user->cotizador = $request->cotizador;
                        }else{
                            
                        }

                        if (isset($request->calculadora)) { 
                            $user->calculadora = $request->calculadora;
                        }else{
                            
                        }
                        if (isset($request->whatsapp)) { 
                            $user->whatsapp = $request->whatsapp;
                        }else{
                            
                        }
                        if (isset($request->description)) { 
                            $user->description = $request->description;
                        }else{
                            
                        }
                     
                        if (isset($request->twitter)) { 
                            $user->twitter = $request->twitter;
                        }else{
                            
                        }
                        if (isset($request->facebook)) { 
                            $user->facebook = $request->facebook;
                        }else{
                            
                        }
        
                        if (isset($request->linkedin)) { 
                            $user->linkedin = $request->linkedin;
                        }else{
                            
                        }
                        if (isset($request->instagram)) { 
                            $user->instagram = $request->instagram;
                        }else{
                            
                        }
                        if (isset($request->certificacion)) { 
                            $user->certificacion = $request->certificacion;
                        }else{
                            
                        }



                        if (isset($request->oficinas)) { 
                             $oficinas = array();
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                            $user->oficinas = $oficinas;
                        }else{
                            $oficinas = null;
                        }

                        $productos = array();
                        if (isset($request->productos)) { 
                            foreach ($request->productos as $key => $value) {
                                array_push($productos, $value);
                            }
                            $productos = implode(",", $productos);
                            $user->productos = $productos;
                        }else{
                            
                        }

                        $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
                        $oficinas = array();
                        
                        if (isset($request->oficinas)) { 
                            foreach ($request->oficinas as $key => $value) {
                                $image = $value;
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = str_replace('data:image/jpg;base64,', '', $image);
                                $image = str_replace('data:image/png;base64,', '', $image);
                                $image = str_replace(' ', '+', $image);
                                $imageName = rand().'.'.'jpg';
                                File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                                array_push($oficinas, $imageName);
                            }
                            $oficinas = implode(",", $oficinas);
                        }else{
                            $oficinas = null;
                        }
                
                        $user->save();
                
                        return "https://socasesores.com/micrositios-seguros/".$url;
                    }
                }
            }else{
                return "Falta el Id sisec";
            }

        }else{
            return "Token Incorrecto";
        }
        
    }

    public function update(Request $request, $idbroker)
    {
        if ($request->token === "&elYYxm$*wm4") {
            function clean($string) {
                $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                $string = strtolower($string);
             
                return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
            }
            $user = User::where('id_sisec', $idbroker)->first();
            if ($user === null) {
                return "No se encontro registro";
            }
            $id = $user->id;
            $url = $user->url;
           
            if (isset($name_full)) { 
                $url = clean($name_full);
                $user->name = $name_full;
                $user->url = $url;
            }else{
                
            }
            if (isset($request->email)) { 
                $user->email = $request->email;
            }else{
                
            }
            if (isset($request->phone)) { 
                $user->phone = $request->phone;
            }else{
                
            }

            $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;

            if ($direccion != "") {
                $client = new Client();
                $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$direccion.'&key=AIzaSyCKCFLBTkEow5a8eOSEp4-exz0xHO_ob6U');
                $res = json_decode($res->getBody());

                $user->lat = $res->results[0]->geometry->location->lat;
                $user->lng = $res->results[0]->geometry->location->lng;
                $user->direccion = $direccion;
            }else{

            }

            

            if (isset($request->logo)) { 
                $user->logo = $request->logo;
            }else{
                
            }

            if (isset($request->active)) { 
                $user->active = $request->active;
            }else{
                
            }

            if (isset($request->agente_soc)) { 
                $user->agente_soc = $request->agente_soc;
            }else{
                
            }

            if (isset($request->cotizador)) { 
                $user->cotizador = $request->cotizador;
            }else{
                
            }

            if (isset($request->calculadora)) { 
                $user->calculadora = $request->calculadora;
            }else{
                
            }
            if (isset($request->whatsapp)) { 
                $user->whatsapp = $request->whatsapp;
            }else{
                
            }
            if (isset($request->description)) { 
                $user->description = $request->description;
            }else{
                
            }
         
            if (isset($request->twitter)) { 
                $user->twitter = $request->twitter;
            }else{
                
            }
            if (isset($request->facebook)) { 
                $user->facebook = $request->facebook;
            }else{
                
            }
            if (isset($request->tipo)) { 
                $user->tipo = $request->tipo;
            }else{
                
            }
            if (isset($request->linkedin)) { 
                $user->linkedin = $request->linkedin;
            }else{
                
            }
            if (isset($request->instagram)) { 
                $user->instagram = $request->instagram;
            }else{
                
            }
            if (isset($request->certificacion)) { 
                $user->certificacion = $request->certificacion;
            }else{
                
            }



            if (isset($request->oficinas)) { 
                 $oficinas = array();
                foreach ($request->oficinas as $key => $value) {
                    $image = $value;
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = str_replace('data:image/jpg;base64,', '', $image);
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = rand().'.'.'jpg';
                    File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                    array_push($oficinas, $imageName);
                }
                $oficinas = implode(",", $oficinas);
                $user->oficinas = $oficinas;
            }else{
                $oficinas = null;
            }

            $productos = array();
            if (isset($request->productos)) { 
                foreach ($request->productos as $key => $value) {
                    array_push($productos, $value);
                }
                $productos = implode(",", $productos);
                $user->productos = $productos;
            }else{
                
            }

            $direccion = $request->calle." ".$request->n_exterior." ".$request->codigo_postal." ".$request->municipio." ".$request->estado;
            $oficinas = array();
            
            if (isset($request->oficinas)) { 
                foreach ($request->oficinas as $key => $value) {
                    $image = $value;
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = str_replace('data:image/jpg;base64,', '', $image);
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = rand().'.'.'jpg';
                    File::put(storage_path('app/public/images/oficinas'). '/' . $imageName, base64_decode($image));
                    array_push($oficinas, $imageName);
                }
                $oficinas = implode(",", $oficinas);
            }else{
                $oficinas = null;
            }
    
            $user->save();
    
            return url('/')."/".$url;
        }else{
            return "Token Incorrecto";
        }

    }

    public function exportAll3(Request $request)
    {
        $users = DB::connection('mysql2')->table('user_asesores')->select("user_asesores.name","user_asesores.tipo","user_asesores.url","users.url","users.name")->join('users', 'user_asesores.id_office', '=', 'users.id_sisec')->get();
        dd($users);
        //return Excel::download(new UsersExport2, 'users.xlsx');
       
    }

}
