<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use Livewire\Component;

class EvDesempenoDashboardArea extends Component
{
    public $id_evaluacion;

    public $id_area;

    public $evaluacion;

    public $evaluados_tabla;

    public $array_periodos;

    public $periodo_seleccionado = 0;

    public $area;

    public $area_select;

    public $select_area_tabla = 'todos';

    public $select_colaborador_tabla = 'todos';

    public $select_evaluadores_tabla = 'todos';

    public $opciones_area_select;

    public $opciones_evaluadores_select;

    public $evaluadores_evaluado = [];

    public $totales_evaluado = [];

    // public $chartData;
    public $resArea;

    public $resObj;

    public $resComp;

    public $grafica_area = [];

    public $grafica_objetivos = [];

    public $grafica_competencias = [];

    public $promedio_evaluados_area = [];

    public $escalas = [];

    public $promedio_total = 0;

    public $promedio_objetivos = 0;

    public $promedio_competencias = 0;

    public $resultadoPeriodos;

    public function mount($id_evaluacion, $id_area)
    {
        $this->id_evaluacion = $id_evaluacion;
        $this->area = Area::getIdNameAll()->find($id_area);
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        $this->id_area = $id_area;

        $this->secciones();
        $this->evaluadoTotales();
        $this->evaluadores();

        if ($this->evaluacion->activar_objetivos) {
            $this->obtenerEscalas();
            $this->resultadoObjetivos();
        }

        if ($this->evaluacion->activar_competencias) {
            $this->resultadoCompetencias();
        }

        $this->porcentajesTotalesPeriodos();
        $this->porcentajesTotales();
    }

    public function render()
    {
        //Datos generales
        $this->evaluados_tabla = EvaluacionDesempeno::with('evaluados');

        // if ($this->select_area_tabla != "todos") {
        //     $this->evaluados_tabla->whereHas('evaluados.empleado', function ($query) {
        //         $query->where('area_id', $this->select_area_tabla);
        //     });
        // }

        // if ($this->select_colaborador_tabla != "todos") {
        //     $this->evaluados_tabla->whereHas('evaluados', function ($query) {
        //         $query->where('id', $this->select_colaborador_tabla);
        //     });
        // }

        // if ($this->select_evaluadores_tabla != "todos") {
        //     if ($this->evaluacion->activar_competencias) {
        //         $this->evaluados_tabla->whereHas('evaluados.evaluadoresCompetencias', function ($query) {
        //             $query->where('evaluador_desempeno_id', $this->select_evaluadores_tabla);
        //         });
        //     }

        //     if ($this->evaluacion->activar_competencias) {
        //         $this->evaluados_tabla->whereHas('evaluados.evaluadoresObjetivos', function ($query) {
        //             $query->where('evaluador_desempeno_id', $this->select_evaluadores_tabla);
        //         });
        //     }
        // }

        $this->evaluados_tabla = $this->evaluados_tabla->find($this->id_evaluacion);

        $this->cargarTablas();

        return view('livewire.ev-desempeno-dashboard-area');
    }

    public function cambiarSeccion($llave)
    {
        $this->periodo_seleccionado = $llave;

        $this->cargarTablas();

        $this->porcentajesTotales();
    }

    public function cargarTablas()
    {
        if ($this->evaluacion->activar_objetivos) {

            $cumpObj = [
                'labels' => $this->resObj['nombres'][$this->periodo_seleccionado],
                'data' => $this->resObj['resultados'][$this->periodo_seleccionado],
            ];
            $this->emit('cumplimientoObj', $cumpObj);

            $escObj = [
                'labels' => $this->escalas['nombres'][$this->periodo_seleccionado],
                'colores' => $this->escalas['colores'][$this->periodo_seleccionado],
                'resultados' => $this->escalas['resultados'][$this->periodo_seleccionado],
            ];

            $this->emit('escalasObj', $escObj);
        }

        if ($this->evaluacion->activar_competencias) {
            $cumpComp = [
                'labels' => $this->resComp['nombres'][$this->periodo_seleccionado],
                'data' => $this->resComp['resultados'][$this->periodo_seleccionado],
            ];

            $this->emit('cumplimientoComp', $cumpComp);
        }
    }

    public function secciones()
    {
        foreach ($this->evaluacion->periodos as $key => $periodo) {
            $this->array_periodos[$key] = [
                'id_periodo' => $periodo->id,
                'nombre_evaluacion' => $periodo->nombre_evaluacion,
                'fecha_inicio' => $periodo->fecha_inicio,
                'fecha_fin' => $periodo->fecha_fin,
                'habilitado' => $periodo->habilitado,
                'finalizado' => $periodo->finalizado,
            ];
        }
    }

    public function evaluadoTotales()
    {

        // Calificaciones Generales (todos los periodos)
        // foreach ($this->evaluacion->evaluados as $evaluado) {
        //     $this->totales_evaluado[$evaluado->id] =
        //         [
        //             'competencias' => $evaluado->calificaciones_competencias_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100),
        //             'objetivos' => $evaluado->calificaciones_objetivos_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
        //             'final' => $evaluado->calificaciones_competencias_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100) + $evaluado->calificaciones_objetivos_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
        //         ];
        //     $this->promedio_evaluados_area[$evaluado->empleado->area_id]["promedioEvdsObjs"][] = $this->totales_evaluado[$evaluado->id]["objetivos"];
        // }
        foreach ($this->array_periodos as $key => $periodo) {
            foreach ($this->evaluacion->evaluados as $evaluado) {
                if ($evaluado->empleado->area_id == $this->id_area) {
                    // Calculating competencies and objectives scores once
                    $competenciasPromedio = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo['id_periodo'])['promedio_total'];
                    $objetivosPromedio = $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo['id_periodo'])['promedio_total'];

                    // Storing calculated values in arrays
                    $this->totales_evaluado[$key][$evaluado->id] = [
                        'competencias' => $competenciasPromedio * ($this->evaluacion->porcentaje_competencias / 100),
                        'objetivos' => $objetivosPromedio * ($this->evaluacion->porcentaje_objetivos / 100),
                        'final' => $competenciasPromedio * ($this->evaluacion->porcentaje_competencias / 100) + $objetivosPromedio * ($this->evaluacion->porcentaje_objetivos / 100),
                    ];

                    $areaId = $evaluado->empleado->area_id;
                    if (! isset($this->promedio_evaluados_area[$key][$areaId]['promedioEvdsObjs'])) {
                        $this->promedio_evaluados_area[$key][$areaId]['promedioEvdsObjs'] = [];
                    }
                    $this->promedio_evaluados_area[$key][$areaId]['promedioEvdsObjs'][] = $this->totales_evaluado[$key][$evaluado->id]['objetivos'];
                }
            }
        }
    }

    public function obtenerEscalas()
    {
        foreach ($this->array_periodos as $key_periodo => $periodo) {
            foreach ($this->evaluacion->escalas as $key_escala => $escala) {
                $this->escalas['nombres'][$key_periodo][] = $escala->parametro;
                $this->escalas['colores'][$key_periodo][] = $escala->color;
                $this->escalas['valores'][$key_periodo][] = $escala->valor;
                $this->escalas['resultados'][$key_periodo][] = 0;
            }

            foreach ($this->evaluacion->evaluados as $evaluado) {
                if ($evaluado->empleado->area_id == $this->id_area) {
                    // Extract the values from the 'value' parameter of each $escala
                    $values = $this->escalas['valores'][$key_periodo];
                    // Sort the values in ascending order
                    sort($values);
                    // Get the $promedio value
                    $promedio = $this->promedio_evaluados_area[$key_periodo][$evaluado->empleado->area_id]['promedioEvdsObjs'];
                    $promedioValue = is_array($promedio) ? $promedio[0] : $promedio;

                    // Find the position of $promedio in the sorted array
                    $index = 0;
                    foreach ($values as $value) {
                        if ($promedioValue > $value) {
                            $index++;
                        } elseif ($promedioValue === $value) {
                            // Handle the case when $promedioValue is exactly equal to $value
                            break;
                        } else {
                            break; // Exit the loop once we find the correct position
                        }
                    }
                    $arreglo_cuenta = array_count_values($this->escalas['resultados'][$key_periodo]);
                    $cuenta = $arreglo_cuenta[0];

                    // dd(array_count_values($this->escalas['resultados'][$key_periodo]));
                    if ($index == $cuenta) {
                        $index--;
                    }
                    // $index now represents the position where $promedio falls in the sorted array
                    // You can use $index to determine which $escala $promedio belongs to
                    $this->escalas['resultados'][$key_periodo][$index]++;
                }
            }
        }
    }

    public function enviarRecordatorio()
    {
        dump($this->evaluacion->evaluados);
        foreach ($this->evaluacion->evaluados as $evaluado) {
            if ($evaluado->estatus_evaluado == false) {
                dd($evaluado);
                if ($this->evaluacion->activar_competencias) {
                    // code...
                    dd($evaluado->evaluadoresCompetencias);
                }

                if ($this->evaluacion->activar_objetivos) {
                    // code...
                    dd($evaluado->evaluadoresObjetivos);
                }
            }
            // dd($evaluado->empleado->email);
        }
    }

    public function cerrarEvaluacion()
    {
        $this->evaluacion->update(
            [
                'estatus' => 2,
            ]
        );
    }

    public function evaluadores()
    {
        $empleados = Empleado::getAllDataColumns();

        foreach ($this->evaluacion->evaluados as $evaluado) {
            if ($evaluado->empleado->area_id == $this->id_area) {
                foreach ($evaluado->nombres_evaluadores as $key => $evdr) {
                    // Determine which evaluator information to fetch based on evaluation settings
                    $evaluadorId = $this->evaluacion->activar_objetivos && $this->evaluacion->activar_competencias ? $evdr : $evdr->evaluador_desempeno_id;
                    // Fetch evaluator information
                    $evaluador = $empleados->find($evaluadorId);
                    // Store evaluator information
                    $this->evaluadores_evaluado[$evaluado->id][] = [
                        'id' => $evaluador->evaluador_desempeno_id,
                        'nombre' => $evaluador->name,
                        'foto' => $evaluador->avatar,
                    ];
                }
            }
        }

        $allEvaluators = array_reduce($this->evaluadores_evaluado, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);

        $uniqueEvaluators = array_map('unserialize', array_unique(array_map('serialize', $allEvaluators)));

        $uniqueEvaluators = array_values($uniqueEvaluators);

        $this->opciones_evaluadores_select = $uniqueEvaluators;
    }

    public function resultadoObjetivos()
    {
        foreach ($this->array_periodos as $key_periodo => $periodo) {
            $query_objetivos = CuestionarioObjetivoEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)
                ->where('periodo_id', $periodo['id_periodo'])
                ->get();

            foreach ($query_objetivos as $pregunta) {
                $lista_objetivos[] = $pregunta->infoObjetivo->tipo_objetivo;
            }

            $lo = array_unique($lista_objetivos);

            foreach ($lo as $o) {
                $this->grafica_objetivos['nombres'][$key_periodo][] = $o;
            }

            $promedios_tipo_objetivo = [];
            // Filter evaluados by area_id
            $evaluadosCollectionFiltered = $this->evaluacion->evaluados->filter(function ($evaluado) {
                return $evaluado->empleado->area_id == $this->id_area;
            });

            foreach ($this->grafica_objetivos['nombres'][$key_periodo] as $key_nombre => $tipo) {
                // Map evaluados to their respective "calificacion_total" values for the current tipo
                $calificacionTotals = $evaluadosCollectionFiltered->flatMap(function ($evaluado) use ($tipo, $periodo) {
                    return collect($evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo['id_periodo'])['calif_total'])
                        ->filter(function ($objetivo) use ($tipo) {
                            return $objetivo['tipo'] == $tipo;
                        })
                        ->pluck('calificacion_total');
                });

                $promedios_tipo_objetivo[$key_nombre][$tipo] = $calificacionTotals->avg();
                $this->grafica_objetivos['resultados'][$key_periodo][] = $promedios_tipo_objetivo[$key_nombre][$tipo];
            }
            $this->resObj['nombres'][$key_periodo] = $this->grafica_objetivos['nombres'][$key_periodo];
            $this->resObj['resultados'][$key_periodo] = $this->grafica_objetivos['resultados'][$key_periodo];
        }
    }

    public function resultadoCompetencias()
    {
        foreach ($this->array_periodos as $key_periodo => $periodo) {
            $query_competencias = CuestionarioCompetenciaEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)
                ->where('periodo_id', $periodo['id_periodo'])
                ->get();

            foreach ($query_competencias as $pregunta) {
                $lista_competencias[] = $pregunta->infoCompetencia->competencia;
            }

            $lc = array_unique($lista_competencias);

            foreach ($lc as $c) {
                $this->grafica_competencias['nombres'][$key_periodo][] = $c;
            }

            $promedios_tipo_competencias = [];

            // Filter evaluados by area_id
            $evaluadosCollectionFiltered = $this->evaluacion->evaluados->filter(function ($evaluado) {
                return $evaluado->empleado->area_id == $this->id_area;
            });

            foreach ($this->grafica_competencias['nombres'][$key_periodo] as $key_nombre => $competencia) {
                // Map evaluados to their respective "calificacion_total" values for the current competencia
                $calificacionTotals = $evaluadosCollectionFiltered->flatMap(function ($evaluado) use ($competencia, $periodo) {
                    return collect($evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo['id_periodo'])['calif_total'])
                        ->filter(function ($competencias) use ($competencia) {
                            return $competencias['competencia'] == $competencia;
                        })
                        ->pluck('calificacion_total');
                });

                $promedios_tipo_competencias[$key_nombre][$competencia] = $calificacionTotals->avg();
                $this->grafica_competencias['resultados'][$key_periodo][] = $promedios_tipo_competencias[$key_nombre][$competencia];
            }
            // dd($this->grafica_competencias["resultados"][$key_periodo]);
            $this->resComp['nombres'][$key_periodo] = $this->grafica_competencias['nombres'][$key_periodo];
            $this->resComp['resultados'][$key_periodo] = $this->grafica_competencias['resultados'][$key_periodo];
        }
    }

    public function calculatePromedio($periodo = null)
    {
        $this->promedio_objetivos = 0;
        $this->promedio_competencias = 0;

        if ($this->evaluacion->activar_objetivos) {
            $suma_objetivos = array_sum($this->grafica_objetivos['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $n_objetivos = count($this->grafica_objetivos['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $this->promedio_objetivos = round(($suma_objetivos / $n_objetivos) * $this->evaluacion->porcentaje_objetivos / 100, 2);
        }

        if ($this->evaluacion->activar_competencias) {
            $suma_competencias = array_sum($this->grafica_competencias['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $n_competencias = count($this->grafica_competencias['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $this->promedio_competencias = round(($suma_competencias / $n_competencias) * $this->evaluacion->porcentaje_competencias / 100, 2);
        }

        return $this->promedio_competencias + $this->promedio_objetivos;
    }

    public function porcentajesTotales()
    {
        $this->promedio_total = $this->calculatePromedio();
    }

    public function porcentajesTotalesPeriodos()
    {
        foreach ($this->array_periodos as $key => $periodo) {
            $this->resultadoPeriodos[$key] = $this->calculatePromedio($key);
        }
    }
}
