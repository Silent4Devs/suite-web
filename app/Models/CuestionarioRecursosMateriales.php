<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioRecursosMateriales extends Model
{
    use HasFactory;

    public $table = 'cuestionario_recursos_materiales';

    public $fillable = [
        'id',
        'equipos',
        'impresoras',
        'telefono',
        'otro',
        'escenario',
        'cuestionario_id',
    ];
}
