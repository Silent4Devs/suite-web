<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionesEvaluados extends Model
{
    use HasFactory;

    protected $table = 'ev360_evaluaciones_evaluados';

    protected $fillable = [
        'id',
        'evaluacion_id',
        'evaluado_id',
        'created_at',
        'updated_at',
        'puesto_id',
    ];
}
