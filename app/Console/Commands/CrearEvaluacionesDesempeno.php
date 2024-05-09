<?php

namespace App\Console\Commands;

use App\Mail\EvaluacionesDesempenoFaltaCompetencias;
use App\Mail\EvaluacionesDesempenoFaltaObjetivos;
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
        $correodestinatario = "victor.rodriguez@silent4business.com";

        $evaluaciones = EvaluacionDesempeno::getAll()->where('estatus', '=', 3);
        foreach ($evaluaciones as $evaluacion) {
            foreach ($evaluacion->periodos as $periodo) {
                if ($periodo->habilitado && !$periodo->finalizado) {
                    $periodoInicio = Carbon::parse($periodo->fecha_inicio);
                    $periodoAnteriorInicio = $periodoInicio->copy()->subWeeks(2);

                    if ($hoy->between($periodoAnteriorInicio, $periodoInicio)) {
                        $crearCuestionario = true;

                        $puestosSinCompetencias = [];
                        $evaluadoresProbObjetivos = [];

                        foreach ($evaluacion->evaluados as $evaluado) {
                            if ($evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                                if ($evaluado->empleado->competencias_asignadas == 0) {
                                    $puestosSinCompetencias[] = $evaluado->empleado->puesto;
                                }

                                if ($evaluado->empleado->objetivos_asignados["cuenta"] == 0 || $evaluado->empleado->objetivos_asignados["pendientes"] == true) {
                                    $evaluadoresProbObjetivos[] = $evaluado->empleado->name;
                                }
                            } elseif ($evaluacion->activar_objetivos && !$evaluacion->activar_competencias) {
                                if ($evaluado->empleado->objetivos_asignados["cuenta"] == 0 || $evaluado->empleado->objetivos_asignados["pendientes"] == true) {
                                    $evaluadoresProbObjetivos[] = $evaluado->empleado->name;
                                }
                            } elseif (!$evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                                if ($evaluado->empleado->competencias_asignadas == 0) {
                                    $puestosSinCompetencias[] = $evaluado->empleado->puesto;
                                }
                            }
                        }

                        if ($evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                            if (!empty($puestosSinCompetencias)) {
                                $emailCompetencia = new EvaluacionesDesempenoFaltaCompetencias($evaluacion->nombre, $periodo->nombre_evaluacion, $puestosSinCompetencias);
                                Mail::to(removeUnicodeCharacters($correodestinatario))->queue($emailCompetencia);
                                $crearCuestionario = false;
                            }

                            if (!empty($evaluadoresProbObjetivos)) {
                                $emailObjetivos = new EvaluacionesDesempenoFaltaObjetivos($evaluacion->nombre, $periodo->nombre_evaluacion, $evaluadoresProbObjetivos);
                                Mail::to(removeUnicodeCharacters($correodestinatario))->queue($emailObjetivos);
                                $crearCuestionario = false;
                            }
                        } elseif ($evaluacion->activar_objetivos && !$evaluacion->activar_competencias) {
                            if (!empty($evaluadoresProbObjetivos)) {
                                $emailObjetivos = new EvaluacionesDesempenoFaltaObjetivos($evaluacion->nombre, $periodo->nombre_evaluacion, $evaluadoresProbObjetivos);
                                Mail::to(removeUnicodeCharacters($correodestinatario))->queue($emailObjetivos);
                                $crearCuestionario = false;
                            }
                        } elseif (!$evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                            if (!empty($puestosSinCompetencias)) {
                                $emailCompetencias = new EvaluacionesDesempenoFaltaCompetencias($evaluacion->nombre, $periodo->nombre_evaluacion, $puestosSinCompetencias);
                                Mail::to(removeUnicodeCharacters($correodestinatario))->queue($emailCompetencias);
                                $crearCuestionario = false;
                            }
                        }

                        if ($crearCuestionario) {
                            //FuncionCrearCuestionario
                        }
                    }
                }
            }
        }
    }
}
