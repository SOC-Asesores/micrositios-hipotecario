<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registros;
use App\Models\Archivos;
use App\Models\Folders;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;

class ArchivosController extends Controller
{
    public function index($url, Request $request)
    {
        $registro_id = Registros::where('url',$url)->first();
        $linea = $registro_id->nombre;
        $archivos = Archivos::where('registro_id',$registro_id->id)->get();
        return view('archivos',['archivos' => $archivos, 'linea' => $linea]);
    }

    public function archivo(Request $request)
    {
    	$registro_id = intval($request->id);
    	$archivos = Archivos::where('id',$registro_id)->get();
    	return response()->json(['archivos' => $archivos]);
    }

    public function archivos(Request $request)
    {
    	$registro_id = intval($request->id);
    	$archivos = Archivos::where('id',$registro_id)->get();
    	return response()->json(['archivos' => $archivos]);
    }

    public function delete(Request $request)
    {
        $id = intval($request->id);
        $files = Archivos::where('id', $id)->first();
            $path = public_path()."/archivos/".$files->url;
            File::delete($path);
        Archivos::destroy($id);

        return "Success";
    }
    public function saveName(Request $request)
    {
        $archivos = Archivos::find($request->id);
        $url = Str::slug($request->name, '-');
        $url = $url."-".rand(0,10);
        $archivos->nombre = $request->name;
        if ($request->folder != "") {
            $archivos->categoria = $request->folder;
        }
        $archivos->url = $url;
        $archivos->save();
        return "suceess";
    }
    public function insertRegistro(Request $request)
    {
        $nombre = $request->nombre;
        $categoria = $request->categoria;
        $tipo = $request->tipo;
        $descripcion = $request->descripcion;

        //Clean URL
        $url = Str::slug($nombre, '-');
        $url = $url."-".rand();

        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {

                $name = rand().time().'.'.$file->extension();
                $file->move(public_path().'/archivos/', $name);  
                Archivos::insertGetId([
                    'url' => $url,
                    'nombre' => $nombre,
                    'categoria' => $categoria,
                    'tipo' => $tipo,
                    'descripcion' => $descripcion,
                    'url' => $url,
                    'imagen' => $name,
                ]);  
            }
         }
         $folders = Folders::where("id_folder","=","0")->get();
        return view("home_user",["folders"=>$folders]);
    }
    public function categoria($categoria)
    {
        $titulo_object = Folders::where("slug","=",$categoria)->first();
        $titulo = $titulo_object->name;
        $id_titulo = $titulo_object->slug;
        $archivos = Archivos::where('categoria', $categoria)->get();
         $folders = Folders::where("id_folder","=","0")->get();
        return view('archivos',['archivos' => $archivos, 'titulo' => $titulo, 'folders'=>$folders, 'id_titulo'=>$id_titulo]);
    }
}
