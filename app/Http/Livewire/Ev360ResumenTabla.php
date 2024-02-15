<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Admin\RH\EV360EvaluacionesController;
use App\Models\Empleado;
use App\Models\RH\Competencia;
use App\Models\RH\CompetenciaPuesto;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\ObjetivoRespuesta;
use App\Traits\FuncionesEvaluacion360;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Ev360ResumenTabla extends Component
{
    use FuncionesEvaluacion360;
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $evaluacion;

    public $lista_evaluados;

    public $perPage = 5;

    public $search = '';

    public $competencias_evaluadas;

    public $objetivos_evaluados;

    public $rangos;

    public function mount($evaluacion, $rangos = null)
    {
        $this->evaluacion = $evaluacion;
        $this->rangos = $rangos;
    }

    public function render()
    {
        $evaluacion = Evaluacion::select('id', 'nombre')->with('evaluados')->find(intval($this->evaluacion));

        $evaluados = $evaluacion->evaluados;
        $this->lista_evaluados = collect();
        $calificaciones = collect();
        $inaceptable = 0;
        $minimo_aceptable = 0;
        $aceptable = 0;
        $sobresaliente = 0;
        $ev360EvaluacionesController = new EV360EvaluacionesController();
        foreach ($evaluados as $evaluado) {
            // $evaluado->load('area');
            $this->lista_evaluados->push([
                'evaluado' => $evaluado->name,
                'puesto' => $evaluado->puesto,
                'area' => $evaluado->area->area,
                'informacion_evaluacion' => $this->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $evaluado->id),
            ]);
        }
        // dd($this->lista_evaluados);
        foreach ($this->lista_evaluados as $evaluado) {
            if ($evaluado['informacion_evaluacion']['calificacion_final'] <= $this->rangos['inaceptable']) {
                $inaceptable++;
            } elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= $this->rangos['minimo_aceptable']) {
                $minimo_aceptable++;
            } elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= $this->rangos['aceptable']) {
                $aceptable++;
            } elseif ($evaluado['informacion_evaluacion']['calificacion_final'] > $this->rangos['sobresaliente']) {
                $sobresaliente++;
            }
        }

        $calificaciones->push([
            'Inaceptable' => $inaceptable,
            'Mínimo Aceptable' => $minimo_aceptable,
            'Aceptable' => $aceptable,
            'Sobresaliente' => $sobresaliente,
        ]);
        $calificaciones = $calificaciones->first();

        if ($this->search != '') {
            $collection = $this->lista_evaluados->filter(function ($item) {
                return Str::contains(strtolower($item['evaluado']), strtolower($this->search));
            });
        } else {
            $collection = $this->lista_evaluados;
        }
        $offset = max(0, ($this->page - 1) * $this->perPage);
        // need one more here so the simple paginatior knows
        // if there are more pages left
        $items = $collection->slice($offset, $this->perPage + 1);
        $paginator = new Paginator($items, $this->perPage, $this->page);

        $this->competencias_evaluadas = Competencia::find($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id));
        $this->objetivos_evaluados = $this->obtenerCantidadMaximaDeObjetivos($evaluacion->evaluados, $evaluacion->id);

        return view('livewire.ev360-resumen-tabla', ['lista_evaluados', 'calificaciones', 'evaluacion', 'competencias_evaluadas', 'lista' => $collection]);
    }

    // public function paginate($items, $perPage = 5, $page = null, $options = [])
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    //     $items = $items instanceof Collection ? $items : Collection::make($items);
    //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // }

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
        $max = 0;
        foreach ($evaluados as $evaluado) {
            $objetivos = ObjetivoRespuesta::with('objetivo')
                ->where('evaluacion_id', $evaluacion)
                ->where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluado->id)
                ->orderBy('id')->get();
            if ($objetivos->count() > $max) {
                $max = $objetivos->count();
            }
        }

        return $max;
        // $competencias = DB::table('ev360_objetivos_calificaciones')->where('evaluacion_id', $evaluacion);
        // $agrupar_competencias = $competencias->select(DB::raw('count(id) AS total'))->groupBy('evaluado_id')
        //     ->get();

        // return $agrupar_competencias->max('total');
    }

    public function obtenerInformacionDeLaConsultaPorEvaluado($evaluacion, $evaluado)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));
        $evaluado = Empleado::with(['area', 'puestoRelacionado' => function ($q) {
            $q->with('competencias');
        }])->find(intval($evaluado));
        $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)
            ->get();

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
            $locacionFirmas = 'evaluaciones/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $evaluacion->nombre) . '/';

            $promedio_competencias_collect = collect();
            // $cantidad_competencias_evaluadas = $evaluado->puestoRelacionado->competencias->count() ? $evaluado->puestoRelacionado->competencias->count() : 1;
            $cantidad_competencias_evaluadas = count($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id, $evaluado->id)) ? count($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id, $evaluado->id)) : 1;
            $lista_autoevaluacion->push([
                'tipo' => 'Autoevaluación',
                'firma' => $filtro_autoevaluacion->first() ? $locacionFirmas . $filtro_autoevaluacion->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_autoevaluacion,
                'evaluaciones' => $filtro_autoevaluacion->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

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
                $jefe_evaluador = Empleado::getAll()->find($jefe_evaluador_id->evaluador_id);
            }

            $lista_jefe_inmediato->push([
                'tipo' => 'Jefe Inmediato',
                'firma' => $filtro_jefe_inmediato->first() ? $locacionFirmas . $filtro_jefe_inmediato->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_jefe_inmediato,
                'evaluaciones' => $filtro_jefe_inmediato->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

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
                'firma' => $filtro_equipo_a_cargo->first() ? $locacionFirmas . $filtro_equipo_a_cargo->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_equipo,
                'evaluaciones' => $filtro_equipo_a_cargo->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

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
                'firma' => $filtro_misma_area->first() ? $locacionFirmas . $filtro_misma_area->first()->firma_evaluador : null,
                'peso_general' => $evaluacion->peso_area,
                'evaluaciones' => $filtro_misma_area->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

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
        $supervisorObjetivos = $evaluadores->filter(function ($item) {
            return intval($item->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
        })->first();
        //        dd($evaluado->supervisor_id, $evaluado->name);
        if ($evaluacion->include_objetivos) {

            $jefe_evaluador_id = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('tipo', '=', 1)
                ->first();

            if ($jefe_evaluador_id == null) {
                $jefe_evaluador = '-';
            } else {
                $jefe_evaluador = Empleado::getAll()->find($jefe_evaluador_id->evaluador_id);
            }

            if ($supervisorObjetivos) {
                $objetivos_calificaciones = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                    return $q->with('metrica');
                }])->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $supervisorObjetivos->evaluador_id)
                    ->orderBy('id')->get();

                $evaluadores_objetivos->push([
                    'id' => $evaluado->supervisor_id, 'nombre' => $evaluado->name,
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
                            'calificacion' => $objetivo->calificacion,
                        ];
                    }),
                ]);
            }
            $calificacion_objetivos = 0;
            if ($evaluadores_objetivos->first()) {
                if (count($evaluadores_objetivos->first()['objetivos'])) {
                    foreach ($evaluadores_objetivos->first()['objetivos'] as $objetivo) {
                        $calificacion_objetivos += $objetivo['calificacion'] / ($objetivo['meta'] > 0 ? $objetivo['meta'] : 1);
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
                'id' => $evaluado->id, 'nombre' => $evaluado->name,
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
                        'calificacion' => $objetivo->calificacion,
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
            'evaluadores' => Empleado::getAll()->find($evaluadores->pluck('evaluador_id')),
        ];
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
