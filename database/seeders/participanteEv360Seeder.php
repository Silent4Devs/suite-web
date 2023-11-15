<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\ObjetivoRespuesta;
use Illuminate\Database\Seeder;

class participanteEv360Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluacionID = 21;
        $evaluadoID = 158;
        $evaluacion = Evaluacion::find($evaluacionID);
        $evaluacion->evaluados()->attach($evaluadoID);
        EvaluadoEvaluador::create([
            'evaluado_id' => $evaluadoID,
            'evaluador_id' => 158,
            'evaluacion_id' => $evaluacionID,
            'peso' => 0,
            'tipo' => EvaluadoEvaluador::AUTOEVALUACION,
        ]);
        EvaluadoEvaluador::create([
            'evaluado_id' => $evaluadoID,
            'evaluador_id' => 137,
            'evaluacion_id' => $evaluacionID,
            'peso' => 60,
            'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO,
        ]);
        EvaluadoEvaluador::create([
            'evaluado_id' => $evaluadoID,
            'evaluador_id' => 253,
            'evaluacion_id' => $evaluacionID,
            'peso' => 20,
            'tipo' => EvaluadoEvaluador::EQUIPO,
        ]);
        EvaluadoEvaluador::create([
            'evaluado_id' => $evaluadoID,
            'evaluador_id' => 138,
            'evaluacion_id' => $evaluacionID,
            'peso' => 20,
            'tipo' => EvaluadoEvaluador::MISMA_AREA,
        ]);

        $evaluadores = [158, 137, 253, 138];
        foreach ($evaluadores as $evaluador) {
            $competencias_por_puesto = Empleado::with(['puestoRelacionado' => function ($q) {
                $q->with(['competencias' => function ($q) {
                    $q->with(['competencia']);
                }]);
            }])->find($evaluadoID);
            $competencias = ! is_null($competencias_por_puesto->puestoRelacionado) ? $competencias_por_puesto->puestoRelacionado->competencias : null;
            if (! is_null($competencias)) {
                foreach ($competencias as $competencia) {
                    EvaluacionRepuesta::create([
                        'calificacion' => 0,
                        'descripcion' => null,
                        'competencia_id' => $competencia->competencia_id,
                        'evaluado_id' => $evaluadoID,
                        'evaluador_id' => $evaluador,
                        'evaluacion_id' => $evaluacionID,
                    ]);
                }
            }
        }

        $evaluadores_objetivos = [158, 137];
        $empleado = Empleado::with('children', 'supervisor', 'objetivos')->find($evaluadoID);
        $objetivos = $empleado->objetivos;
        if (! is_null($objetivos)) {
            foreach ($evaluadores_objetivos as $evaluador) {
                foreach ($objetivos as $objetivo) {
                    ObjetivoRespuesta::create([
                        'meta_alcanzada' => 'Sin evaluar',
                        'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                        'calificacion' => 0,
                        'objetivo_id' => $objetivo->objetivo_id,
                        'evaluado_id' => $evaluadoID,
                        'evaluador_id' => $evaluador,
                        'evaluacion_id' => $evaluacionID,
                    ]);
                }
            }
        }
    }
}
