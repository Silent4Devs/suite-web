<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioRecursosMaterialesAIA extends Model
{
    use HasFactory;

    public $table = 'recursos_materiales_aia';

    public $fillable = [
        'id',
        'equipos',
        'impresoras',
        'telefono',
        'otro',
        'otro_numero',
        'escenario',
        'cuestionario_id',
    ];
}
