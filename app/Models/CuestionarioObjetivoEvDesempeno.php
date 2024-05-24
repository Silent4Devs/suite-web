<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioObjetivoEvDesempeno extends Model
{
    use HasFactory;

    protected $table = 'cuestionario_objetivo_ev_desempenos';

    protected $fillable = [
        'objetivo_id',
        'periodo_id',
        'evaluacion_desempeno_id',
        'evaluado_desempeno_id',
        'evaluador_desempeno_id',
        'calificacion_objetivo',
        'estatus_calificado',
        'aplicabilidad',
    ];

    public function infoObjetivo()
    {
        return $this->belongsTo(CatalogoObjetivosEvDesempeno::class, 'objetivo_id', 'id');
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
        return $this->belongsTo(EvaluadoresEvaluacionObjetivosDesempeno::class, 'evaluador_desempeno_id', 'id');
    }

    public function evidencias()
    {
        return $this->hasMany(EvidenciaObjCuestionarioEvDesempeno::class, 'pregunta_cuest_obj_ev_des_id', 'id');
    }
}
