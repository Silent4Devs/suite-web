<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\ObjetivoRespuesta;
use Illuminate\Database\Seeder;

class AgregarObjetivosParticipanteEv360Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluado = Empleado::getAll()->find(253);
        $evaluacion = Evaluacion::find(21);
        $evaluadores_objetivos = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)->get();
        $objetivos = $evaluado->objetivos;
        if (! is_null($objetivos)) {
            foreach ($evaluadores_objetivos as $evaluador) {
                foreach ($objetivos as $objetivo) {
                    ObjetivoRespuesta::create([
                        'meta_alcanzada' => 'Sin evaluar',
                        'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                        'calificacion' => 0,
                        'objetivo_id' => $objetivo->objetivo_id,
                        'evaluado_id' => $evaluado->id,
                        'evaluador_id' => $evaluador->evaluador_id,
                        'evaluacion_id' => $evaluacion->id,
                    ]);
                }
            }
        }
    }
}
