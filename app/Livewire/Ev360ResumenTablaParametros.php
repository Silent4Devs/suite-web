<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\RH\Competencia;
use App\Models\RH\CompetenciaPuesto;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\ObjetivoRespuesta;
use App\Traits\FuncionesEvaluacion360;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Ev360ResumenTablaParametros extends Component
{
    use FuncionesEvaluacion360;
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $evaluacion;

    public $maxValue = 0;

    public $lista_evaluados;

    public $perPage = 5;

    public $search = '';

    public $competencias_evaluadas;

    public $objetivos_evaluados;

    public $rangos;

    public $colores;

    public function mount($evaluacion, $rangos = null, $colores = null)
    {
        $this->evaluacion = $evaluacion;
        $this->rangos = $rangos;
        $this->colores = $colores;
    }

    public function render()
    {
        $evaluacion = Evaluacion::select('id', 'nombre')->with('evaluados:id,name,area_id,puesto_id')->where('id', '=', intval($this->evaluacion))->first();

        $evaluados = $evaluacion->evaluados;
        $lista_evaluados = collect();
        $calificaciones = collect();

        $this->maxValue = $this->findClosestValueToMax();

        foreach ($evaluados as $evaluado) {
            $lista_evaluados->push([
                'evaluado' => $evaluado->name,
                'puesto' => $evaluado->puesto,
                'area' => $evaluado->area->area,
                'informacion_evaluacion' => $this->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $evaluado->id),
            ]);
        }

        foreach ($lista_evaluados as $evaluado) {
            $calificacionFinal = $evaluado['informacion_evaluacion']['calificacion_final'];
            foreach ($this->rangos as $parametro => $valor) {

                if ($calificacionFinal <= $valor) {

                    $counts[$parametro] = isset($counts[$parametro]) ? $counts[$parametro] + 1 : 1;
                } elseif ($valor == $this->maxValue) {

                    $counts[$parametro] = isset($counts[$parametro]) ? $counts[$parametro] + 1 : 1;
                } elseif ($calificacionFinal > $this->maxValue) {

                    $counts[$parametro] = isset($counts[$parametro]) ? $counts[$parametro] + 1 : 1;
                }
            }
        }
        $calificaciones->push($counts);
        $calificaciones = $calificaciones->first();

        $collection = $lista_evaluados;

        $this->competencias_evaluadas = Competencia::find($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id));

        $this->objetivos_evaluados = $this->obtenerCantidadMaximaDeObjetivos($evaluacion->evaluados, $evaluacion->id);

        return view(
            'livewire.ev360-resumen-tabla-parametros',
            [
                'calificaciones', 'evaluacion',
                'lista' => $collection,
                'maxValue',
            ]
        );
    }

    public function obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion, $evaluado = 0)
    {
        if ($evaluado > 0) {
            $competencias = EvaluacionRepuesta::where('evaluacion_id', $evaluacion)->where('evaluado_id', $evaluado)->pluck('competencia_id')->unique()->toArray();
        } else {
            $competencias = EvaluacionRepuesta::where('evaluacion_id', $evaluacion)->pluck('competencia_id')->unique()->toArray();
        }

        return $competencias;
    }

    public function obtenerCantidadMaximaDeObjetivos($evaluados, $evaluacion)
    {
        $evaluadoIds = $evaluados->pluck('id')->toArray();

        $objetivosCounts = DB::table('ev360_objetivos_calificaciones')
            ->select('evaluado_id', DB::raw('count(*) as count'))
            ->where('evaluacion_id', $evaluacion)
            ->whereIn('evaluado_id', $evaluadoIds)
            ->whereIn('evaluador_id', $evaluadoIds)
            ->groupBy('evaluado_id')
            ->get();

        $max = $objetivosCounts->max('count');

        return $max;
    }

    public function obtenerInformacionDeLaConsultaPorEvaluado($evaluacion, $evaluado)
    {
        $evaluacion = Evaluacion::with('rangos')->find(intval($evaluacion));

        $evaluado = Empleado::select('id', 'name', 'area_id', 'puesto_id', 'supervisor_id')->with(['area:id,area', 'puestoRelacionado.competencias'])
            ->findOrFail(intval($evaluado));

        $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)
            ->get();

        if (isset($evaluacion->rangos)) {
            $rangos = $evaluacion->rangos->pluck('valor')->toArray();
            $escalas = $evaluacion->rangos;
            if (! empty($rangos)) {
                $maxValue = max($rangos);

                sort($rangos);

                $maxKey = array_search($maxValue, $rangos);

                $previousValue = isset($rangos[$maxKey - 1]) ? $rangos[$maxKey - 1] : null;

                $nextValue = isset($rangos[$maxKey + 1]) ? $rangos[$maxKey + 1] : null;

                $closestValue = null;

                if ($previousValue !== null && $nextValue !== null) {
                    $closestValue = floatval(($nextValue - $maxValue) < ($maxValue - $previousValue) ? $nextValue : $previousValue);
                } elseif ($previousValue !== null) {
                    $closestValue = floatval($previousValue);
                } elseif ($nextValue !== null) {
                    $closestValue = floatval($nextValue);
                }
            } else {
                $closestValue = null;
            }
        } else {
            $closestValue = null;
        }

        $calificacion_final = 0;
        $cantidad_competencias_evaluadas = 0;
        $promedio_competencias = 0;
        $promedio_general_competencias = 0;
        $lista_autoevaluacion = collect();
        $lista_jefe_inmediato = collect();
        $lista_equipo_a_cargo = collect();
        $lista_misma_area = collect();
        if ($evaluacion->include_competencias) {
            $filtro_autoevaluacion = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::AUTOEVALUACION;
            });
            $filtro_jefe_inmediato = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
            });
            $filtro_equipo_a_cargo = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::EQUIPO;
            });
            $filtro_misma_area = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::MISMA_AREA;
            });
            $promedio_competencias = 0;
            $locacionFirmas = 'evaluaciones/firmas/'.preg_replace(['/\s+/i', '/-/i'], '_', $evaluacion->nombre).'/';

            $promedio_competencias_collect = collect();
            // $cantidad_competencias_evaluadas = $evaluado->puestoRelacionado->competencias->count() ? $evaluado->puestoRelacionado->competencias->count() : 1;
            $cantidad_competencias_evaluadas = count($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id, $evaluado->id)) ? count($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id, $evaluado->id)) : 1;
            $lista_autoevaluacion->push([
                'tipo' => 'Autoevaluación',
                'firma' => $filtro_autoevaluacion->first() ? $locacionFirmas.$filtro_autoevaluacion->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_autoevaluacion,
                'evaluaciones' => $filtro_autoevaluacion->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador:id,name')
                        ->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)
                        ->orderBy('id')
                        ->get();

                    $evaluador_empleado = DB::table('empleados')
                        ->select('id', 'name', 'email', 'foto')
                        ->where('id', $evaluador->evaluador_id)
                        ->first();

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);
            $calificacion = 0;

            if (count($lista_autoevaluacion->first()['evaluaciones'])) {
                foreach ($lista_autoevaluacion->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += floatval($competencia['porcentaje']);
                    }
                }

                // $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
                $promedio_competencias_collect->push((($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100));
            }

            $jefe_evaluador_id = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('tipo', '=', 1)
                ->first();

            if ($jefe_evaluador_id == null) {
                $jefe_evaluador = '-';
            } else {
                $jefe_evaluador = Empleado::getAllEvaluaciones()->find($jefe_evaluador_id->evaluador_id);
            }

            $lista_jefe_inmediato->push([
                'tipo' => 'Jefe Inmediato',
                'firma' => $filtro_jefe_inmediato->first() ? $locacionFirmas.$filtro_jefe_inmediato->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_jefe_inmediato,
                'evaluaciones' => $filtro_jefe_inmediato->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador:id,name')
                        ->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)
                        ->orderBy('id')
                        ->get();
                    $evaluador_empleado = DB::table('empleados')
                        ->select('id', 'name', 'email', 'foto')
                        ->where('id', $evaluador->evaluador_id)
                        ->first();

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_jefe_inmediato->first()['evaluaciones'])) {
                foreach ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }

                $promedio_competencias_collect->push((($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100));
            }

            $lista_equipo_a_cargo->push([
                'tipo' => 'Equipo a cargo',
                'firma' => $filtro_equipo_a_cargo->first() ? $locacionFirmas.$filtro_equipo_a_cargo->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_equipo,
                'evaluaciones' => $filtro_equipo_a_cargo->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador:id,name')
                        ->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)
                        ->orderBy('id')
                        ->get();
                    $evaluador_empleado = DB::table('empleados')
                        ->select('id', 'name', 'email', 'foto')
                        ->where('id', $evaluador->evaluador_id)
                        ->first();

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);
            $calificacion = 0;
            if (count($lista_equipo_a_cargo->first()['evaluaciones'])) {
                foreach ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }

                $promedio_competencias_collect->push((($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100));
            }

            $lista_misma_area->push([
                'tipo' => 'Misma área',
                'firma' => $filtro_misma_area->first() ? $locacionFirmas.$filtro_misma_area->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_area,
                'evaluaciones' => $filtro_misma_area->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador:id,name')
                        ->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)
                        ->orderBy('id')
                        ->get();
                    $evaluador_empleado = DB::table('empleados')
                        ->select('id', 'name', 'email', 'foto')
                        ->where('id', $evaluador->evaluador_id)
                        ->first();

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_misma_area->first()['evaluaciones'])) {
                foreach ($lista_misma_area->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }

                $promedio_competencias_collect->push((($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100));
            }

            $cantidad_participantes = $promedio_competencias_collect->count();
            if ($this->empleadoTieneCompetenciasAsignadas($evaluado->id, $evaluacion->id)) {
                $promedio_competencias = floatval(number_format($promedio_competencias_collect->sum(), 2));
                $promedio_general_competencias = floatval(number_format(($promedio_competencias * ($evaluacion->peso_general_competencias / 100)), 2));

                $promedio_general_competencias = $promedio_general_competencias > intval($evaluacion->peso_general_competencias) ? $evaluacion->peso_general_competencias : $promedio_general_competencias;

                $promedio_competencias = $promedio_general_competencias;

                $calificacion_final += $promedio_general_competencias;
            } else {
                $promedio_competencias = 1;
                $promedio_general_competencias = number_format(100, 2);
                $calificacion_final += $evaluacion->peso_general_competencias;
            }
        } else {
            //Logica para cuando no se evaluan competencias
        }

        $promedio_objetivos = 0;
        $promedio_general_objetivos = 0;
        $evaluadores_objetivos = collect();
        $supervisorObjetivos = $evaluadores->firstWhere('tipo', EvaluadoEvaluador::JEFE_INMEDIATO);
        //        dd($evaluado->supervisor_id, $evaluado->name);
        if ($evaluacion->include_objetivos) {

            $jefe_evaluador_id = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('tipo', '=', 1)
                ->first();

            if ($jefe_evaluador_id == null) {
                $jefe_evaluador = '-';
            } else {
                $jefe_evaluador = Empleado::getAllEvaluaciones()->find($jefe_evaluador_id->evaluador_id);
            }

            if ($supervisorObjetivos) {
                $objetivos_calificaciones = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                    return $q->with('metrica');
                }])->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $supervisorObjetivos->evaluador_id)
                    ->orderBy('id')->get();
                $evaluadores_objetivos->push([
                    'id' => $evaluado->supervisor_id,
                    'nombre' => $evaluado->name,
                    'esSupervisor' => true,
                    'esAutoevaluacion' => false,
                    'objetivos' => $objetivos_calificaciones->map(function ($objetivo) {
                        return [
                            'objetivo_calificacion_id' => $objetivo->id,
                            'nombre' => $objetivo->objetivo->nombre,
                            'KPI' => $objetivo->objetivo->KPI,
                            'meta' => $objetivo->objetivo->meta,
                            'descripcion_meta' => $objetivo->objetivo->descripcion_meta,
                            'metrica' => $objetivo->objetivo->metrica->definicion,
                            'meta_alcanzada' => $objetivo->meta_alcanzada,
                            'calificacion' => $this->calificacion_con_parametro($objetivo->calificacion_persepcion, $objetivo->objetivo->meta, $objetivo->evaluacion_id),
                            'calificacion_percepcion' => $objetivo->calificacion_persepcion,
                        ];
                    }),
                ]);
            }
            $calificacion_objetivos = 0;
            if ($evaluadores_objetivos->first()) {
                if (count($evaluadores_objetivos->first()['objetivos'])) {
                    foreach ($evaluadores_objetivos->first()['objetivos'] as $objetivo) {
                        $calificacion_objetivos += $objetivo['calificacion'] / ($objetivo['meta'] > 0 ? $objetivo['meta'] : $closestValue);
                    }
                }
            }

            $objetivos_calificaciones_autoevaluacion = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                return $q->with('metrica');
            }])->where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluado->id)
                ->orderBy('id')->get();

            $evaluadores_objetivos->push([
                'id' => $evaluado->id,
                'nombre' => $evaluado->name,
                'esSupervisor' => false,
                'esAutoevaluacion' => true,
                'objetivos' => $objetivos_calificaciones_autoevaluacion->map(function ($objetivo) {
                    return [
                        'objetivo_calificacion_id' => $objetivo->id,
                        'nombre' => $objetivo->objetivo->nombre,
                        'KPI' => $objetivo->objetivo->KPI,
                        'meta' => $objetivo->objetivo->meta,
                        'descripcion_meta' => $objetivo->objetivo->descripcion_meta,
                        'metrica' => $objetivo->objetivo->metrica->definicion,
                        'meta_alcanzada' => $objetivo->meta_alcanzada,
                        'calificacion' => $this->calificacion_con_parametro($objetivo->calificacion_persepcion, $objetivo->objetivo->meta, $objetivo->evaluacion_id),
                        'calificacion_percepcion' => $objetivo->calificacion_persepcion,
                    ];
                }),
            ]);
            $cantidadObjetivosEvaluados = $objetivos_calificaciones_autoevaluacion->count();

            if ($this->empleadoTieneObjetivosAsignados($evaluado->id, $evaluacion->id)) {
                $promedio_objetivos = ($calificacion_objetivos * 100 / $cantidadObjetivosEvaluados);
                $promedio_general_objetivos = $promedio_objetivos;
                $calificacion_final += $promedio_general_objetivos * ($evaluacion->peso_general_objetivos / 100);
                $promedio_general_objetivos = $promedio_general_objetivos * ($evaluacion->peso_general_objetivos / 100);
            } else {
                $promedio_objetivos = 1;
                $promedio_general_objetivos = 100 * ($evaluacion->peso_general_objetivos / 100);
                $calificacion_final += $evaluacion->peso_general_objetivos;
            }
        }

        return [
            'peso_general_competencias' => $evaluacion->peso_general_competencias,
            'peso_general_objetivos' => $evaluacion->peso_general_objetivos,
            'lista_autoevaluacion' => $lista_autoevaluacion,
            'jefe_evaluador' => $jefe_evaluador,
            'lista_jefe_inmediato' => $lista_jefe_inmediato,
            'lista_equipo_a_cargo' => $lista_equipo_a_cargo,
            'lista_misma_area' => $lista_misma_area,
            'promedio_competencias' => $promedio_competencias,
            'promedio_general_competencias' => number_format($promedio_general_competencias, 2),
            'evaluadores_objetivos' => $evaluadores_objetivos,
            'promedio_objetivos' => $promedio_objetivos,
            'promedio_general_objetivos' => $promedio_general_objetivos,
            'calificacion_final' => $calificacion_final,
            'evaluadores' => Empleado::getAllEvaluaciones()->find($evaluadores->pluck('evaluador_id')),
            'maxParam' => $closestValue,
            'escalas' => $escalas,
        ];
    }

    public function findClosestValueToMax()
    {
        $rangos = [];
        foreach ($this->rangos as $r) {
            $rangos[] = $r;
        }

        // Check if the array is empty
        if (empty($rangos)) {
            return null; // or handle the empty case accordingly
        }

        // Convert array values to integers
        $rangosInt = array_map('intval', $rangos);

        // Find the maximum value
        $maxValue = max($rangosInt);

        // Sort the array in ascending order
        sort($rangosInt);

        // Find the key/index of the maximum value in the sorted array
        $maxKey = array_search($maxValue, $rangosInt);

        // Find the value previous to the maximum value
        $previousValue = isset($rangosInt[$maxKey - 1]) ? $rangosInt[$maxKey - 1] : null;
        // Find the value next to the maximum value
        $nextValue = isset($rangosInt[$maxKey + 1]) ? $rangosInt[$maxKey + 1] : null;

        // Determine which value is closer to the maximum value
        $closestValue = ($nextValue - $maxValue) < ($maxValue - $previousValue) ? $nextValue : $previousValue;
        if ($nextValue === null) {
            $closestValue = $previousValue;
        } elseif ($previousValue === null) {
            $closestValue = $nextValue;
        } else {
            $closestValue = ($nextValue - $maxValue) < ($maxValue - $previousValue) ? $nextValue : $previousValue;
        }

        // dd($previousValue, $nextValue, $maxValue, $closestValue);
        return $closestValue;
    }

    public function calificacion_con_parametro($calificacion, $meta, $evaluacion)
    {
        $ev = Evaluacion::with('rangos')->find($evaluacion);

        $maximo = $ev->rangos->max('valor');

        $valorAntesDeMaximo = $ev->rangos->where('valor', '<', $maximo)->max('valor');

        if ($meta == 0) {
            $meta = $valorAntesDeMaximo;
        }

        if (! empty($this->maxValue)) {
            $regla = $meta / $this->maxValue;
            $nv_cal = $regla * $calificacion;

            return $nv_cal;
        } else {

            if ($valorAntesDeMaximo === null) {
                $valorAntesDeMaximo = $maximo;
            }

            $regla = $meta / $valorAntesDeMaximo;
            $nv_cal = $regla * $calificacion;

            return $nv_cal;
        }
    }

    public function obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion = null)
    {
        $competencias = $this->obtenerCompetenciasDelPuestoDelEvaluadoEnLaEvaluacion($evaluacion->id, $evaluado->id);

        return [
            'id' => $evaluador_empleado->id, 'nombre' => $evaluador_empleado->name,
            'esSupervisor' => $evaluado->supervisorEv360 ? ($evaluado->supervisorEv360->id == $evaluador->evaluador_id ? true : false) : false,
            'esAutoevaluacion' => $evaluado->id == $evaluador->evaluador_id ? true : false,
            'tipo' => $evaluador->tipo_formateado,
            'competencias' => $evaluaciones_competencias->map(function ($competencia) use ($evaluador, $competencias) {
                $nivel_esperado = $competencias->filter(function ($compe) use ($competencia) {
                    return $compe->competencia_id == $competencia->competencia_id;
                })->first();

                if ($nivel_esperado == null) {
                    $n = CompetenciaPuesto::where('competencia_id', '=', $competencia->competencia_id)->first();
                    $nne = $n->nivel_esperado;
                } else {
                    $nne = intval($nivel_esperado->nivel_esperado);
                    // dd($nne);
                }

                $porcentaje = 0;
                if ($competencia->calificacion > 0) {
                    $porcentaje = number_format((($competencia->calificacion) / $nne), 2);
                }

                return [
                    'id_competencia' => $competencia->competencia->id,
                    'competencia' => $competencia->competencia->nombre,
                    'tipo_competencia' => $competencia->competencia->tipo_competencia,
                    'calificacion' => $competencia->calificacion,
                    'porcentaje' => $porcentaje,
                    'evaluado' => $evaluador->evaluado,
                    'peso' => $evaluador->peso,
                    'meta' => $nne,
                    'firma_evaluador' => $evaluador->firma_evaluador,
                    'firma_evaluado' => $evaluador->firma_evaluado,
                ];
            }),
        ];
    }

    public function empleadoTieneCompetenciasAsignadas($empleado, $evaluacion)
    {
        $existsObjetivos = EvaluacionRepuesta::where('evaluado_id', $empleado)->where('evaluacion_id', $evaluacion)->exists();
        if ($existsObjetivos) {
            return true;
        }

        return false;
    }

    public function empleadoTieneObjetivosAsignados($empleado, $evaluacion)
    {
        $existsObjetivos = ObjetivoRespuesta::where('evaluado_id', $empleado)->where('evaluacion_id', $evaluacion)->exists();
        if ($existsObjetivos) {
            return true;
        }

        return false;
    }
}
