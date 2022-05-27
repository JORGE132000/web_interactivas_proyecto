<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logcategorias extends Model
{
    use HasFactory;

    protected $table = 'logcategorias';
    protected $fillable = [
        'idcategoria',

        'categoriaO',

        'categoriaN'
    ];
}
