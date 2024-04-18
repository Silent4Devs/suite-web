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
        'finalizada', //Quizas sea mejor una tabla aparte, debido a que los periodos son variables
        'firma_evaluacion',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'evaluador_desempeno_id', 'id')->select('id', 'name', 'email', 'area_id', 'puesto_id', 'foto');
    }

    public function preguntasCuestionario()
    {
        return $this->hasMany(CuestionarioCompetenciaEvDesempeno::class, 'evaluador_desempeno_id', 'id');
    }

    public function preguntasCuestionarioPeriodo($periodo)
    {
        return $this->hasMany(CuestionarioCompetenciaEvDesempeno::class, 'evaluador_desempeno_id', 'id')
            ->where('periodo_id', $periodo)->get();
    }
}
