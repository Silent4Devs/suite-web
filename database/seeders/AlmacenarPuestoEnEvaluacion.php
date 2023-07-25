<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\RH\Evaluacion;
use Illuminate\Database\Seeder;

class AlmacenarPuestoEnEvaluacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluaciones = Evaluacion::with('evaluados')->get();
        //iterate the evaluations and update pivot evaluado
        foreach ($evaluaciones as $evaluacion) {
            $evaluados = $evaluacion->evaluados;
            $evaluados_puesto = [];
            foreach ($evaluados as $evaluado) {
                $evaluados_puesto[] = [
                    'evaluado_id' => $evaluado->id,
                    'puesto_id' => Empleado::with('puestoRelacionado')->find($evaluado->id)->puestoRelacionado->id,
                ];
            }
            $evaluacion->evaluados()->sync($evaluados_puesto);
        }
    }
}
