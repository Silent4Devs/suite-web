<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioCompetenciaEvDesempeno extends Model
{
    use HasFactory;

    protected $table = 'cuestionario_competencia_ev_desempenos';

    protected $fillable =
        [
            'competencia_id',
            'periodo_id',
            'evaluacion_desempeno_id',
            'evaluado_desempeno_id',
            'evaluador_desempeno_id',
            'calificacion_competencia',
            'estatus_calificado',
        ];

    public function infoCompetencia()
    {
        return $this->belongsTo(CatalogoCompetenciasEvDesempeno::class, 'competencia_id', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(PeriodosEvaluacionDesempeno::class, 'periodo_id', 'id');
    }

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
        return $this->belongsTo(EvaluadoresEvaluacionCompetenciasDesempeno::class, 'evaluador_desempeno_id', 'id');
    }
}
