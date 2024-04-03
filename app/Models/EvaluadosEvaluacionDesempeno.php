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

    protected $appends = ['cuenta_evaluaciones', 'cuenta_evaluaciones_completadas'];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'evaluado_desempeno_id', 'id')->select('id', 'name', 'area_id', 'puesto_id', 'foto');
    }

    public function evaluadoresObjetivos()
    {
        return $this->hasMany(EvaluadoresEvaluacionObjetivosDesempeno::class, 'evaluado_desempeno_id', 'id');
    }

    public function evaluadoresCompetencias()
    {
        return $this->hasMany(EvaluadoresEvaluacionCompetenciasDesempeno::class, 'evaluado_desempeno_id', 'id');
    }

    public function getCuentaEvaluacionesAttribute()
    {
        $total = 0;

        $evaluado = self::find($this->id);

        if ($evaluado->evaluacion->activar_competencias && $this->evaluacion->activar_objetivos) {
            $evaluadoresCompetenciasIds = $this->evaluadoresCompetencias->pluck('evaluador_desempeno_id')->toArray();
            $evaluadoresObjetivosIds = $this->evaluadoresObjetivos->pluck('evaluador_desempeno_id')->toArray();

            // Calculate the distinct count of evaluador_desempeno_id that match in both relations
            $matchingCount = count(array_intersect($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds));

            // Calculate the count of evaluador_desempeno_id that don't match in both relations
            $distinctCount = count(array_diff($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds))
                + count(array_diff($evaluadoresObjetivosIds, $evaluadoresCompetenciasIds));

            $total = $matchingCount + $distinctCount;
        } elseif ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos == false) {
            $total = $evaluado->evaluadoresCompetencias->count();
        } elseif ($evaluado->evaluacion->activar_competencias == false && $evaluado->evaluacion->activar_objetivos) {
            $total = $evaluado->evaluadoresObjetivos->count();
        }

        return $total;
    }

    public function getCuentaEvaluacionesCompletadasAttribute()
    {
        $total = 0;

        $evaluado = self::find($this->id);

        if ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos) {
            $evaluadoresCompetenciasIds = $evaluado->evaluadoresCompetencias->where('finalizada', true)->pluck('evaluador_desempeno_id')->toArray();
            $evaluadoresObjetivosIds = $evaluado->evaluadoresObjetivos->where('finalizada', true)->pluck('evaluador_desempeno_id')->toArray();

            // Calculate the distinct count of evaluador_desempeno_id that match in both relations
            $matchingCount = count(array_intersect($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds));

            // Calculate the count of evaluador_desempeno_id that don't match in both relations
            $distinctCount = count(array_diff($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds))
                + count(array_diff($evaluadoresObjetivosIds, $evaluadoresCompetenciasIds));

            $total = $matchingCount + $distinctCount;
        } elseif ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos == false) {
            $total = $evaluado->evaluadoresCompetencias->where('finalizada', true)->count();
        } elseif ($evaluado->evaluacion->activar_competencias == false && $evaluado->evaluacion->activar_objetivos) {
            $total = $evaluado->evaluadoresObjetivos->where('finalizada', true)->count();
        }

        return $total;
    }
}
