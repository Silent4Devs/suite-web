<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluadoresEvaluacionObjetivosDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evaluadores_evaluacion_objetivos_desempenos';

    protected $fillable = [
        'evaluado_desempeno_id',
        'evaluador_desempeno_id',
        'periodo_id',
        'porcentaje_objetivos',
        'finalizada',
        'firma_evaluador',
        'firma_evaluado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'evaluador_desempeno_id', 'id')->select('id', 'name', 'email', 'area_id', 'puesto_id', 'foto');
    }

    public function evaluacion()
    {
        return $this->hasOneThrough(
            EvaluacionDesempeno::class,
            EvaluadosEvaluacionDesempeno::class,
            'id',
            'id',
            'evaluado_desempeno_id',
            'evaluacion_desempeno_id'
        );
    }

    public function periodo()
    {
        return $this->belongsTo(PeriodosEvaluacionDesempeno::class, 'periodo_id', 'id');
    }

    public function preguntasCuestionario()
    {
        return $this->hasMany(CuestionarioObjetivoEvDesempeno::class, 'evaluador_desempeno_id', 'id');
    }

    public function preguntasCuestionarioAplican()
    {
        return $this->hasMany(CuestionarioObjetivoEvDesempeno::class, 'evaluador_desempeno_id', 'id')
            ->where('aplicabilidad', true);
    }

    public function preguntasCuestionarioAplicanPeriodo($periodo)
    {
        return $this->hasMany(CuestionarioObjetivoEvDesempeno::class, 'evaluador_desempeno_id', 'id')
            ->where('periodo_id', $periodo)->where('aplicabilidad', true)->get();
    }
}
