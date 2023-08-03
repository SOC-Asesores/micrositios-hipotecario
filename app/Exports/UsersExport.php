<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use URL;
use DB;

class UsersExport implements FromCollection
{
    public function collection()
    {
       return $users = DB::connection('mysql2')->table('user_asesores')->select("user_asesores.name","user_asesores.tipo","user_asesores.url","users.url","users.name")->join('users', 'user_asesores.id_office', '=', 'users.id_sisec')->get();
    }
}