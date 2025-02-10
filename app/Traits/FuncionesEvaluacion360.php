<?php

// make a trait to use in the model

namespace App\Traits;

use App\Models\Puesto;
use App\Models\RH\Evaluacion;

trait FuncionesEvaluacion360
{
    public function obtenerCompetenciasDelPuestoDelEvaluadoEnLaEvaluacion($evaluacion, $evaluado)
    {
        $puesto = Evaluacion::find($evaluacion)->evaluados()->where('evaluado_id', $evaluado)->first();
        $comp = Puesto::with('competencias')->find($puesto->pivot->puesto_id);

        if ($puesto && isset($comp->competencias)) {
            $competencias = $comp->competencias;
        } else {
            $competencias = Puesto::with('competencias')->find($puesto->puesto_id)->competencias;
        }

        return $competencias;
    }
}
