<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_desempenos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'activar_objetivos',
        'porcentaje_objetivos',
        'activar_competencias',
        'porcentaje_competencias',
        'estatus',
    ];
}
