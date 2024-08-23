<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\CatalogoObjetivosEvDesempeno;
use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use App\Models\EvaluadoresEvaluacionCompetenciasDesempeno;
use App\Models\EvaluadoresEvaluacionObjetivosDesempeno;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EvDesempenoDashboardPersonal extends Component
{
    use LivewireAlert;

    public $id_evaluacion;

    public $id_evaluado;

    public $evaluacion;

    public $info_evaluado;

    public $evaluado;

    public $array_periodos;

    public $periodo_seleccionado = 0;

    public $areas;

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

    public $calificacion_escala;

    public $evldInfo;

    public $competenciasEvaluado;

    public $objetivosEvaluado;

    public $tiposObj;

    public $contadorColumnas = 4;

    public $cabecera_objetivos;

    public $array_mod_evaluadores_objetivos = [];

    public $array_mod_evaluadores_competencias = [];

    protected $listeners = [
        'modificarEvaluadoresPeriodoObjetivos' => 'modificarEvaluadoresPeriodoObjetivos',
        'modificarEvaluadoresPeriodoCompetencias' => 'modificarEvaluadoresPeriodoCompetencias',
        'deleteEvaluadorObjetivos' => 'removeEvaluadorPeriodoObjetivos',
        'deleteEvaluadorCompetencias' => 'removeEvaluadorPeriodoCompetencias',
    ];

    public function mount($id_evaluacion, $id_evaluado)
    {
        $this->id_evaluacion = $id_evaluacion;
        $this->id_evaluado = $id_evaluado;
        $this->areas = Area::getIdNameAll();
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);

        $evld_tabla = EvaluacionDesempeno::with('evaluados')->find($this->id_evaluacion);

        $this->evaluado = $evld_tabla->evaluados->find($this->id_evaluado);
        // dd($this->evaluado->empleado->registrosHistorico);
        $this->cargaDatos();

        $this->arreglosEvaluadores();
    }

    public function render()
    {
        $modificar_empleados = Empleado::getAllDataColumns()->sortBy('name');

        $this->cargarTablas();

        return view('livewire.ev-desempeno-dashboard-personal', compact('modificar_empleados'));
    }

    public function cargaDatos()
    {
        $this->secciones();
        $this->evaluadoTotales();
        $this->evaluadores();

        if ($this->evaluacion->activar_objetivos) {
            $this->resultadoObjetivos();
            $this->obtenerEscalas();
            $this->tablaObjetivos();
        }

        if ($this->evaluacion->activar_competencias) {
            $this->resultadoCompetencias();
            $this->tablaCompetencias();
        }

        $this->porcentajesTotalesPeriodos();
        $this->porcentajesTotales();
    }

    public function cambiarSeccion($llave)
    {
        $this->periodo_seleccionado = $llave;
        $this->cargarTablas();
    }

    public function cargarTablas()
    {
        if ($this->evaluacion->activar_objetivos) {

            $cumpObj = [
                'labels' => $this->resObj['nombres'][$this->periodo_seleccionado],
                'data' => $this->resObj['resultados'][$this->periodo_seleccionado],
            ];
            $this->dispatch('cumplimientoObj', cumpObj: $cumpObj);

            $escObj = [
                'labels' => $this->escalas['nombres'],
                'colores' => $this->escalas['colores'],
                'data' => $this->escalas['resultados'][$this->periodo_seleccionado],
            ];

            $this->dispatch('escalasObj', escObj: $escObj);
        }

        if ($this->evaluacion->activar_competencias) {
            $cumpComp = [
                'labels' => $this->resComp['nombres'][$this->periodo_seleccionado],
                'data' => $this->resComp['resultados'][$this->periodo_seleccionado],
            ];

            $this->dispatch('cumplimientoComp', cumpComp: $cumpComp);

            $cumpCompRadar = [
                'labels' => $this->resComp['nombres'][$this->periodo_seleccionado],
                'data' => $this->resComp['resultado_competencia'][$this->periodo_seleccionado],
                'data2' => $this->resComp['nivel_esperado'][$this->periodo_seleccionado],
            ];

            $this->dispatch('cumplimientoRadarComp', cumpCompRadar: $cumpCompRadar);
        }

        $this->porcentajesTotales();
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
        foreach ($this->array_periodos as $key => $periodo) {
            $evaluado = $this->evaluado;
            $this->info_evaluado = $evaluado;
            $this->totales_evaluado[$key][$evaluado->id] =
                [
                    'competencias' => $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo['id_periodo'])['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100),
                    'objetivos' => $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo['id_periodo'])['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
                    'escalas' => $evaluado->calificacionesEscalasEvaluadoPeriodo($periodo['id_periodo']),
                    'final' => $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo['id_periodo'])['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100) + $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo['id_periodo'])['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
                ];
            $this->promedio_evaluados_area[$key][$evaluado->empleado->area_id]['promedioEvdsObjs'][] = $this->totales_evaluado[$key][$evaluado->id]['objetivos'];
        }
    }

    public function arreglosEvaluadores()
    {
        foreach ($this->array_periodos as $key => $periodo) {
            $evaluadoresObjetivos = $this->evaluado->evaluadoresObjetivos($periodo['id_periodo'])->where('evaluador_desempeno_id', '!=', $this->info_evaluado->empleado->id);
            $evaluadoresCompetencias = $this->evaluado->evaluadoresCompetencias($periodo['id_periodo'])->where('evaluador_desempeno_id', '!=', $this->info_evaluado->empleado->id);

            foreach ($evaluadoresObjetivos as $key_evaluador => $evaluadorO) {
                $this->array_mod_evaluadores_objetivos[$key][] =
                    [
                        'id_registro_evaluador' => $evaluadorO->id,
                        'id_empleado_evaluador' => $evaluadorO->empleado->id,
                        'nombre_evaluador' => $evaluadorO->empleado->name,
                        'porcentaje_objetivos' => $evaluadorO->porcentaje_objetivos,
                    ];
            }

            foreach ($evaluadoresCompetencias as $key_evaluador => $evaluadorC) {
                $this->array_mod_evaluadores_competencias[$key][] =
                    [
                        'id_registro_evaluador' => $evaluadorC->id,
                        'id_empleado_evaluador' => $evaluadorC->empleado->id,
                        'nombre_evaluador' => $evaluadorC->empleado->name,
                        'porcentaje_competencias' => $evaluadorC->porcentaje_competencias,
                    ];
            }
        }
    }

    public function obtenerEscalas()
    {
        foreach ($this->evaluacion->escalas as $key => $escala) {
            $this->escalas['nombres'][$key] = $escala->parametro;
            $this->escalas['colores'][$key] = $escala->color;
        }
        $evaluado = $this->evaluado;

        foreach ($this->array_periodos as $key_periodo => $periodo) {
            $this->calificacion_escala = [];
            foreach ($this->totales_evaluado[$key_periodo][$evaluado->id]['escalas']['calif_escala'] as $key => $objEsc) {
                $infoObjetivo = CatalogoObjetivosEvDesempeno::find($objEsc['objetivo_id']);

                $currentCondition = null; // Track the currently assigned condition

                foreach ($infoObjetivo->escalas as $obj_esc) {
                    $conditionMet = $this->evaluateCondition($objEsc['calificacion_total'], $obj_esc);
                    if ($objEsc['estatus_calificado'] == false && $objEsc['calificacion_total'] == 0) {
                        $this->setValues($infoObjetivo->id, null, $key_periodo);
                    } else {
                        if ($conditionMet) {
                            // If the condition is met, update the assigned condition and values
                            $currentCondition = $obj_esc;
                            $this->setValues($infoObjetivo->id, $obj_esc->parametro, $key_periodo);
                        } elseif ($currentCondition !== null && $currentCondition->valor === $obj_esc->valor) {
                            // If a subsequent condition matches the current condition's value, update the assigned condition and values
                            $currentCondition = $obj_esc;
                            $this->setValues($infoObjetivo->id, $obj_esc->parametro, $key_periodo);
                        }
                    }
                }
            }

            if ($periodo['habilitado'] || $periodo['finalizado']) {
                // Filter out null values before counting
                $filteredValues = array_filter($this->calificacion_escala[$key_periodo], function ($value) {
                    return $value !== null;
                });

                // Count the filtered values
                $counts = array_count_values($filteredValues);

                // Map the counts to their respective positions in reference to $this->escalas['nombres']
                $matchedCounts = array_map(function ($value) use ($counts) {
                    // If the value exists in $counts array, return its count, otherwise return 0
                    return isset($counts[$value]) ? $counts[$value] : 0;
                }, $this->escalas['nombres']);
                $this->escalas['resultados'][$key_periodo] = $matchedCounts;

                $cuenta = count($this->escalas['nombres']);
            } else {
                $this->escalas['resultados'][$key_periodo] = 0;
            }
        }

        $this->contadorColumnas += $cuenta;
    }

    private function evaluateCondition($calificacion_objetivo, $obj_esc)
    {
        switch ($obj_esc->condicion) {
            case '1':
                return $calificacion_objetivo < $obj_esc->valor;
            case '2':
                return $calificacion_objetivo <= $obj_esc->valor;
            case '3':
                return $calificacion_objetivo == $obj_esc->valor;
            case '4':
                return $calificacion_objetivo > $obj_esc->valor;
            case '5':
                return $calificacion_objetivo >= $obj_esc->valor;
            default:
                return true; // Default condition, always true
        }
    }

    private function setValues($objetivoId, $parametro, $periodo)
    {
        $this->calificacion_escala[$periodo][$objetivoId] = $parametro;
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

        $evaluado = $this->evaluado;

        foreach ($evaluado->nombres_evaluadores as $key => $evdr) {
            $evaluador = $empleados->find($evdr);
            $this->evaluadores_evaluado[$evaluado->id][] = [
                'id' => $evaluador->evaluador_desempeno_id,
                'nombre' => $evaluador->name,
                // 'email' => $evaluador->email, //No necesario
                'foto' => $evaluador->foto,
            ];
        }
    }

    public function resultadoObjetivos()
    {
        foreach ($this->array_periodos as $key_periodo => $periodo) {
            $query_objetivos = CuestionarioObjetivoEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)
                ->where('periodo_id', $periodo['id_periodo'])
                ->get();
            // dd($query_objetivos, $this->array_periodos, $key_periodo);
            $lista_objetivos = [];

            foreach ($query_objetivos as $pregunta) {
                $lista_objetivos[] = $pregunta->infoObjetivo->tipo_objetivo;
            }

            $lo = array_unique($lista_objetivos);

            foreach ($lo as $o) {
                $this->grafica_objetivos['nombres'][$key_periodo][] = $o;
            }

            $promedios_tipo_objetivo = [];

            // Access single evaluado instead of collection
            $evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);

            if ($periodo['habilitado'] || $periodo['finalizado']) {
                foreach ($this->grafica_objetivos['nombres'][$key_periodo] as $key_nombre => $tipo) {
                    $calificacionTotals = collect($evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo['id_periodo'])['calif_total'])
                        ->filter(function ($objetivo) use ($tipo) {
                            return $objetivo['tipo'] == $tipo;
                        })
                        ->pluck('calificacion_total');

                    $promedios_tipo_objetivo[$key_nombre][$tipo] = $calificacionTotals->avg();
                    $this->grafica_objetivos['resultados'][$key_periodo][] = $promedios_tipo_objetivo[$key_nombre][$tipo];
                }

                $this->resObj['nombres'][$key_periodo] = $this->grafica_objetivos['nombres'][$key_periodo];
                $this->resObj['resultados'][$key_periodo] = $this->grafica_objetivos['resultados'][$key_periodo];
            } else {
                $this->resObj['nombres'][$key_periodo] = 'NA';
                $this->resObj['resultados'][$key_periodo] = 0;
            }
        }
    }

    public function resultadoCompetencias()
    {
        foreach ($this->array_periodos as $key_periodo => $periodo) {
            $query_competencias = CuestionarioCompetenciaEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)
                ->where('evaluado_desempeno_id', $this->id_evaluado)
                ->where('periodo_id', $periodo['id_periodo'])
                ->get();

            foreach ($query_competencias as $pregunta) {
                $lista_competencias[] = $pregunta->infoCompetencia->competencia;
            }

            $lc = array_unique($lista_competencias);

            foreach ($lc as $c) {
                $this->grafica_competencias['nombres'][$key_periodo][] = $c;
            }

            $evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);

            $calificaciones = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo['id_periodo']);
            if ($periodo['habilitado'] || $periodo['finalizado']) {
                // dump($key_periodo);
                foreach ($calificaciones['calif_total'] as $key => $cal) {
                    $this->resComp['nombres'][$key_periodo][] = $cal['competencia'];
                    $this->resComp['resultados'][$key_periodo][] = $cal['calificacion_total'];
                    $this->resComp['nivel_esperado'][$key_periodo][] = $cal['nivel_esperado'];
                    $this->resComp['resultado_competencia'][$key_periodo][] = $cal['promedio_competencias'];
                }
            } else {
                // dump($key_periodo);
                $this->resComp['nombres'][$key_periodo][] = 'NA';
                $this->resComp['resultados'][$key_periodo][] = 0;
                $this->resComp['nivel_esperado'][$key_periodo][] = 0;
                $this->resComp['resultado_competencia'][$key_periodo][] = 0;
            }
        }
        // dd($this->resComp);
    }

    public function calculatePromedio($periodo = null)
    {
        $this->promedio_objetivos = 0;
        $this->promedio_competencias = 0;

        $validacion = empty($this->grafica_objetivos['resultados'][$periodo ?? $this->periodo_seleccionado]);

        if ($this->evaluacion->activar_objetivos && ! $validacion) {
            $suma_objetivos = array_sum($this->grafica_objetivos['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $n_objetivos = count($this->grafica_objetivos['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $this->promedio_objetivos = round(($suma_objetivos / $n_objetivos) * $this->evaluacion->porcentaje_objetivos / 100, 2);
        } else {
            $suma_objetivos = 0;
            $n_objetivos = 0;
            $this->promedio_objetivos = 0;
        }

        if ($this->evaluacion->activar_competencias && ! $validacion) {
            $suma_competencias = array_sum($this->resComp['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $n_competencias = count($this->resComp['resultados'][$periodo ?? $this->periodo_seleccionado]);
            $this->promedio_competencias = round(($suma_competencias / $n_competencias) * $this->evaluacion->porcentaje_competencias / 100, 2);
        } else {
            $suma_objetivos = 0;
            $n_objetivos = 0;
            $this->promedio_objetivos = 0;
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
            if ($periodo['habilitado'] || $periodo['finalizado']) {
                $this->resultadoPeriodos[$key] = $this->calculatePromedio($key);
            }
        }
    }

    public function tablaCompetencias()
    {
        $evaluadoresC = $this->evaluado->evaluadoresCompetencias;

        foreach ($this->array_periodos as $key_periodo => $periodo) {
            foreach ($evaluadoresC as $key_evaluador => $evaluador) {
                if ($periodo['habilitado'] || $periodo['finalizado']) {
                    $competencias = $evaluador->preguntasCuestionarioPeriodo($periodo['id_periodo']);
                } else {
                    $competencias = 'NA';
                }

                $competencias_evaluado[$key_periodo][$evaluador->id] = is_array($competencias) ? $competencias : [];
            }
        }

        $this->competenciasEvaluado = $competencias_evaluado;
    }

    public function tablaObjetivos()
    {
        $objetivos_evaluado = [];

        // Grouping objetivos by periodo and tipo_objetivo
        foreach ($this->array_periodos as $key_periodo => $periodo) {
            $objetivosPorPeriodoAuto = CuestionarioObjetivoEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)
                ->where('periodo_id', $periodo['id_periodo'])
                ->where('evaluado_desempeno_id', $this->id_evaluado)
                ->with('infoObjetivo')
                ->get();

            $objetivosPorPeriodoEv = CuestionarioObjetivoEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)
                ->where('periodo_id', $periodo['id_periodo'])
                ->where('evaluado_desempeno_id', $this->id_evaluado)
                ->with('infoObjetivo')
                ->get();

            // Grouping by tipo_objetivo
            $objetivosEvaluado[$key_periodo] = [];

            if ($periodo['habilitado'] || $periodo['finalizado']) {
                foreach ($objetivosPorPeriodoAuto as $objetivoAuto) {
                    $tipoObjetivo = $objetivoAuto->infoObjetivo->tipo_objetivo;
                    $objetivosEvaluado[$key_periodo][$tipoObjetivo]['autoevaluacion'][] = $objetivoAuto;
                }

                foreach ($objetivosPorPeriodoEv as $objetivoEv) {
                    $tipoObjetivo = $objetivoEv->infoObjetivo->tipo_objetivo;
                    $objetivosEvaluado[$key_periodo][$tipoObjetivo]['evaluacion'][] = $objetivoEv;
                }

                $cuenta = count($objetivosEvaluado[$key_periodo][$tipoObjetivo]['evaluacion']); // Update $cuenta
            }
        }

        $this->cabecera_objetivos = $this->evaluado->evaluadoresObjetivos->where('id', '!=', $this->id_evaluado);

        // dd($this->cabecera_objetivos);

        $this->contadorColumnas += $cuenta;
        $this->objetivosEvaluado = $objetivosEvaluado;
    }

    public function agregarEvaluadorPeriodoObjetivos($keyPeriodo)
    {
        // dd($keyPeriodo);
        $this->array_mod_evaluadores_objetivos[$keyPeriodo][] =
            [
                'id_registro_evaluador' => 0,
                'id_empleado_evaluador' => 0,
                'nombre_evaluador' => 'Sin Asignar',
                'porcentaje_objetivos' => 0,
            ];
        // dd($this->array_mod_evaluadores_objetivos[$keyPeriodo]);
    }

    public function agregarEvaluadorPeriodoCompetencias($keyPeriodo)
    {
        $this->array_mod_evaluadores_competencias[$keyPeriodo][] =
            [
                'id_registro_evaluador' => 0,
                'id_empleado_evaluador' => 0,
                'nombre_evaluador' => 'Sin Asignar',
                'porcentaje_competencias' => 0,
            ];
    }

    public function removeEvaluadorPeriodoObjetivos($keyPeriodo, $keyEvaluador)
    {
        // Perform your deletion logic here
        // For example:
        $borrarRegistro = $this->array_mod_evaluadores_objetivos[$keyPeriodo][$keyEvaluador];
        // dd($keyPeriodo, $keyEvaluador, $borrarRegistro);
        if ($borrarRegistro['id_registro_evaluador'] != 0) {
            unset($this->array_mod_evaluadores_objetivos[$keyPeriodo][$keyEvaluador]);
            $this->array_mod_evaluadores_objetivos = array_values($this->array_mod_evaluadores_objetivos);
            EvaluadoresEvaluacionObjetivosDesempeno::find($borrarRegistro['id_registro_evaluador'])->delete();
        } else {
            unset($this->array_mod_evaluadores_objetivos[$keyPeriodo][$keyEvaluador]);
            $this->array_mod_evaluadores_objetivos = array_values($this->array_mod_evaluadores_objetivos);
        }
        // Then, you can emit an event to notify the frontend if needed
    }

    public function removeEvaluadorPeriodoCompetencias($keyPeriodo, $keyEvaluador)
    {
        // Perform your deletion logic here
        // For example:
        $borrarRegistro = $this->array_mod_evaluadores_competencias[$keyPeriodo][$keyEvaluador];
        // dd($keyPeriodo, $keyEvaluador, $borrarRegistro);
        if ($borrarRegistro['id_registro_evaluador'] != 0) {
            unset($this->array_mod_evaluadores_competencias[$keyPeriodo][$keyEvaluador]);
            $this->array_mod_evaluadores_competencias = array_values($this->array_mod_evaluadores_competencias);
            EvaluadoresEvaluacionCompetenciasDesempeno::find($borrarRegistro['id_registro_evaluador'])->delete();
        } else {
            unset($this->array_mod_evaluadores_competencias[$keyPeriodo][$keyEvaluador]);
            $this->array_mod_evaluadores_competencias = array_values($this->array_mod_evaluadores_competencias);
        }
        // Then, you can emit an event to notify the frontend if needed
    }

    public function modificarEvaluadoresPeriodoObjetivos($keyObj)
    {
        $evaluadores = $this->array_mod_evaluadores_objetivos[$keyObj];
        $totalPorcentaje = 0;
        $error = false; // Bandera para detectar errores

        foreach ($evaluadores as $evaluador) {
            $validator = Validator::make($evaluador, [
                'id_registro_evaluador' => 'nullable|integer',
                'id_empleado_evaluador' => 'required|integer|min:1',
                'porcentaje_objetivos' => 'required|numeric|min:0.01|max:100|regex:/^\d+(\.\d{1,2})?$/',
            ], [
                'id_empleado_evaluador.min' => 'Debe seleccionar un colaborador', // Mensaje personalizado
            ]);

            if ($validator->fails()) {
                // Disparamos el evento de validación con los mensajes de error
                $this->dispatch('validacionObjetivos', [
                    'title' => 'Validación Incorrecta',
                    'text' => implode(', ', $validator->errors()->all()),
                    'icon' => 'error',
                ]);

                $error = true;
                break; // Salimos del loop si hay un error
            }

            $totalPorcentaje += $evaluador['porcentaje_objetivos'];
        }

        // Validación de que la suma total sea igual a 100
        if (! $error && round($totalPorcentaje, 2) !== 100.00) {
            $this->dispatch('validacionObjetivos', [
                'title' => 'Error en la suma de porcentajes',
                'text' => 'La suma del porcentaje de los objetivos debe ser igual a 100.',
                'icon' => 'error',
            ]);

            return;
        }

        // Si no hay errores, procesamos la actualización
        if (! $error) {
            foreach ($evaluadores as $evaluador) {
                EvaluadoresEvaluacionObjetivosDesempeno::updateOrCreate([
                    'id' => $evaluador['id_registro_evaluador'],
                ], [
                    'evaluado_desempeno_id' => $this->id_evaluado,
                    'evaluador_desempeno_id' => $evaluador['id_empleado_evaluador'],
                    'periodo_id' => $this->array_periodos[$keyObj]['id_periodo'],
                    'porcentaje_objetivos' => $evaluador['porcentaje_objetivos'],
                ]);
            }
            $this->dispatch('evaluadoresObjetivosModificados');
            // $evld_tabla = EvaluacionDesempeno::with('evaluados')->find($this->id_evaluacion);
            $this->array_mod_evaluadores_objetivos = null;
            $this->array_mod_evaluadores_competencias = null;
            $this->cargaDatos();
            $this->arreglosEvaluadores();
        }
    }

    public function modificarEvaluadoresPeriodoCompetencias($keyComp)
    {
        $evaluadores = $this->array_mod_evaluadores_competencias[$keyComp];
        $totalPorcentaje = 0;
        $error = false; // Bandera para detectar errores

        foreach ($evaluadores as $evaluador) {
            $validator = Validator::make($evaluador, [
                'id_registro_evaluador' => 'nullable|integer',
                'id_empleado_evaluador' => 'required|integer|min:1',
                'porcentaje_competencias' => 'required|numeric|min:0.01|max:100|regex:/^\d+(\.\d{1,2})?$/',
            ], [
                'id_empleado_evaluador.min' => 'Debe seleccionar un colaborador', // Mensaje personalizado
            ]);

            if ($validator->fails()) {
                // Disparamos el evento de validación con los mensajes de error
                $this->dispatch('validacionCompetencias', [
                    'title' => 'Validación Incorrecta',
                    'text' => implode(', ', $validator->errors()->all()),
                    'icon' => 'error',
                ]);

                $error = true;
                break; // Salimos del loop si hay un error
            }

            $totalPorcentaje += $evaluador['porcentaje_competencias'];
        }

        // Validación de que la suma total sea igual a 100
        if (! $error && round($totalPorcentaje, 2) !== 100.00) {
            $this->dispatch('validacionCompetencias', [
                'title' => 'Error en la suma de porcentajes',
                'text' => 'La suma del porcentaje de las competencias  debe ser igual a 100.',
                'icon' => 'error',
            ]);

            return;
        }

        // Si no hay errores, procesamos la actualización
        if (! $error) {
            foreach ($evaluadores as $key => $evaluador) {
                EvaluadoresEvaluacionCompetenciasDesempeno::updateOrCreate([
                    'id' => $evaluador['id_registro_evaluador'],
                ], [
                    'evaluado_desempeno_id' => $this->id_evaluado,
                    'evaluador_desempeno_id' => $evaluador['id_empleado_evaluador'],
                    'periodo_id' => $this->array_periodos[$keyComp]['id_periodo'],
                    'porcentaje_competencias' => $evaluador['porcentaje_competencias'],
                ]);
            }
            $this->dispatch('evaluadoresCompetenciasModificados');
            // $evld_tabla = EvaluacionDesempeno::with('evaluados')->find($this->id_evaluacion);
            $this->array_mod_evaluadores_objetivos = null;
            $this->array_mod_evaluadores_competencias = null;
            $this->cargaDatos();
            $this->arreglosEvaluadores();
        }
    }
}
