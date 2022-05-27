<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logarticulos extends Model
{
    use HasFactory;

    protected $table = 'logarticulos';
    protected $fillable = [
        'idarticulo',
        
        'nombreO',
        'precioO',
        'descripcionO',
        'categoriaO',
        'image_pathO',

        'nombreN',
        'precioN',
        'descripcionN',
        'categoriaN',
        'image_pathN'
    ];
}
