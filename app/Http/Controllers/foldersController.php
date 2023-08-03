<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folders;
use App\Models\Archivos;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;

class foldersController extends Controller
{
    public function index(Request $request)
    {
       $folders = Folders::where("id_folder","=","0")->get();
        return view("home_user",["folders"=>$folders]);
    }

    public function checkFolder(Request $request)
    {
      $folder_name = $request->folder;
      $id_folder = Folders::where("slug","=",$folder_name)->first();
      $id_folder = $id_folder->id;
      $folders = Folders::where("id_folder","=",$id_folder)->get();
      return $folders;
    }
    public function insertFolder(Request $request)
    {
        $nombre = $request->nombre;
        $category_father = $request->category_up;
        //Clean URL
        $url = Str::slug($nombre, '-');
        $url = $url."-".rand();
        $files = $request->hasfile('files_2');
        if(isset($files))
        {
                $id_folder = Folders::where("slug","=",$category_father)->first();
                $files = $request->file("files_2");

                $id_folder = $id_folder->id;
                $name = rand().time().'.'.$request->file('files_2')->extension();
                $files->move(public_path().'/archivos/', $name);  
                Folders::insertGetId([
                    'slug' => $url,
                    'name' => $nombre,
                    'image' => $name,
                    'id_folder' => $id_folder
                ]);  
            
         }
         $folders = Folders::where("id_folder","=","0")->get();
        return view("home_user",["folders"=>$folders]);
    }
    public function updateFolder(Request $request)
    {
        $folder = Folders::find($request->id);
        $slug = $folder->slug;
        $url = Str::slug($request->name, '-');
        $url = $url."-".rand(0,10);
        $folder->name = $request->name;
        $folder->save();
    }
    public function saveName(Request $request)
    {
        $folder = Folders::where("slug","=",$request->id)->first();
        $id = $folder->id;
        $folder = Folders::find($id);
        $url = Str::slug($request->name, '-');
        $url = $url."-".rand(0,10);
        $folder->name = $request->name;
        $folder->slug = $url;
        $archivos = Archivos::where("categoria","=",$request->id)->get();
        
        foreach ($archivos as $key => $value) {
            $archivo = $value->id;
            $archivo = Archivos::find($archivo);
            $archivo->categoria = $url;
            $archivo->save();
        }
        $folder->save();
        return "Success";
    }
}
