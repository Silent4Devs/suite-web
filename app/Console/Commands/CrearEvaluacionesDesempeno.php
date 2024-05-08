<?php

namespace App\Console\Commands;

use App\Mail\EvaluacionesDesempenoFaltaCompetencias;
use App\Models\EvaluacionDesempeno;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CrearEvaluacionesDesempeno extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evaluaciones:crear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear Evaluaciones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hoy = Carbon::today();
        //Correos de lista Informativa
        $correodestinatario = "victor.rodriguez@silent4business.com";

        $evaluaciones = EvaluacionDesempeno::getAll()->where('estatus', '=', 3);
        foreach ($evaluaciones as $evaluacion) {
            $crearCuestionario = true;
            $validacionCompetencias = true;

            foreach ($evaluacion->periodos as $periodo) {
                $puestosSinCompetencias = [];
                if ($periodo->habilitado && !$periodo->finalizado) {
                    $periodoInicio = Carbon::parse($periodo->fecha_inicio);
                    $periodoAnteriorInicio = $periodoInicio->copy()->subWeeks(2);

                    if ($evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                        if ($hoy->between($periodoAnteriorInicio, $periodoInicio)) {
                            foreach ($evaluacion->evaluados as $evaluado) {
                                if ($evaluado->empleado->competencias_asignadas > 0) {
                                    $validacionCompetencias = false;
                                    $puestosSinCompetencias[] = $evaluado->empleado->puesto;
                                }
                            }
                            if (!$validacionCompetencias) {
                                $email = new EvaluacionesDesempenoFaltaCompetencias($evaluacion->nombre, $periodo->nombre_evaluacion, $puestosSinCompetencias);

                                Mail::to(removeUnicodeCharacters($correodestinatario))->queue($email);

                                $crearCuestionario = false;
                            }
                        }
                    } elseif ($evaluacion->activar_objetivos && !$evaluacion->activar_competencias) {
                        if ($hoy->between($periodoAnteriorInicio, $periodoInicio)) {
                        }
                    } elseif (!$evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                        if ($hoy->between($periodoAnteriorInicio, $periodoInicio)) {
                            foreach ($evaluacion->evaluados as $evaluado) {
                                if ($evaluado->empleado->competencias_asignadas == 0) {
                                    $validacionCompetencias = false;
                                    $puestosSinCompetencias[] = $evaluado->empleado->puesto;
                                }
                            }
                            if (!$validacionCompetencias) {
                                $email = new EvaluacionesDesempenoFaltaCompetencias($evaluacion->nombre, $periodo->nombre_evaluacion, $puestosSinCompetencias);

                                Mail::to(removeUnicodeCharacters($correodestinatario))->queue($email);
                                $crearCuestionario = false;
                            }
                        }
                    }
                }
            }
            if ($crearCuestionario) {
                //FuncionCrearCuestionario
            }
        }
    }
}
