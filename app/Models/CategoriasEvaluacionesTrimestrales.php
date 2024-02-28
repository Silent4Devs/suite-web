<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriasEvaluacionesTrimestrales extends Model
{
    use HasFactory;

    protected $table = "categorias_evaluaciones_trimestrales";

    protected $fillable =
    [
        'nombre_categoria',
        'descripcion',
    ];
}
