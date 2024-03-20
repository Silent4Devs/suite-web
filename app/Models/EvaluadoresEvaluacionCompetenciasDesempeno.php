<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluadoresEvaluacionCompetenciasDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evaluadores_evaluacion_competencias_desempenos';

    protected $fillable = [
        'evaluado_desempeno_id',
        'evaluador_desempeno_id',
        'porcentaje_competencias',
    ];
}
