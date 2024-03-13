<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluadosEvaluacionDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evaluados_evaluacion_desempenos';

    protected $fillable = [
        'evaluacion_desempeno_id',
        'evaluado_desempeno_id',
    ];
}
