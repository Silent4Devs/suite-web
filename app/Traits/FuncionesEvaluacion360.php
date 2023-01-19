<?php

//make a trait to use in the model

namespace App\Traits;

use App\Models\Puesto;
use App\Models\RH\Evaluacion;

trait FuncionesEvaluacion360
{
    public function obtenerCompetenciasDelPuestoDelEvaluadoEnLaEvaluacion($evaluacion, $evaluado)
    {
        $puesto = Evaluacion::find($evaluacion)->evaluados()->where('evaluado_id', $evaluado)->first();
        $competencias = Puesto::with('competencias')->find($puesto->pivot->puesto_id)->competencias;

        return $competencias;
    }
}
