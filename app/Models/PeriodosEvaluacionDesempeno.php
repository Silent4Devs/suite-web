<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodosEvaluacionDesempeno extends Model
{
    use HasFactory;

    protected $table = 'periodos_evaluacion_desempenos';

    protected $fillable =
        [
            'evaluacion_desempeno_id',
            'nombre_evaluacion',
            'fecha_inicio',
            'fecha_fin',
            'habilitado',
            'finalizado',
        ];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }
}
