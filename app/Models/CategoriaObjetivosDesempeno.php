<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaObjetivosDesempeno extends Model
{
    use HasFactory;

    protected $table = 'categoria_objetivos_desempenos';

    protected $fillable =
    [
        'nombre',
        'descripcion'
    ];
}
