<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folders extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'image',
        'name',
        'id_folder',
        'updated_at',
        'created_at'
    ];
}
