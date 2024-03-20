<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioObjetivoEvDesempeno extends Model
{
    use HasFactory;

    protected $table = 'cuestionario_objetivo_ev_desempenos';

    protected $fillable = [
        'objetivo',
        'descripcion_objetivo',
        'KPI',
        'tipo_objetivo',
        'unidad_objetivo',
        'valor_maximo_unidad_objetivo',
        'valor_minimo_unidad_objetivo',
        'evaluacion_desempeno_id',
        'evaluado_desempeno_id',
        'evaluador_desempeno_id',
        'calificacion_objetivo',
        'estatus_calificado',
    ];

    public function evaluacionDesempeno()
    {
        return $this->belongsTo(EvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }

    public function evaluadoDesempeno()
    {
        return $this->belongsTo(EvaluadosEvaluacionDesempeno::class, 'evaluado_desempeno_id', 'id');
    }

    public function evaluadorDesempeno()
    {
        return $this->belongsTo(EvaluadoresEvaluacionObjetivosDesempeno::class, 'evaluador_desempeno_id', 'id');
    }
}
