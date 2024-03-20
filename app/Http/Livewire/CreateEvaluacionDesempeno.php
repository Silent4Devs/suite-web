<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use App\Models\EvaluadoresEvaluacionCompetenciasDesempeno;
use App\Models\EvaluadoresEvaluacionObjetivosDesempeno;
use App\Models\EvaluadosEvaluacionDesempeno;
use App\Models\PeriodosEvaluacionDesempeno;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateEvaluacionDesempeno extends Component
{
    use LivewireAlert;

    public $paso = 1;

    //Variables primer paso
    public $nombre_evaluacion = null;
    public $descripcion_evaluacion = null;
    public $activar_objetivos = false;
    public $porcentaje_objetivos = 50;
    public $activar_competencias = false;
    public $porcentaje_competencias = 50;
    public $datosPaso1;

    //Variables segundo paso
    public $periodo_evaluacion;
    public $mensual = false;
    public $bimestral = false;
    public $trimestral = false;
    public $semestral = false;
    public $anualmente = false;
    public $abierta = false;
    //Arreglo para recopilar periodos
    public $arreglo_periodos = [];
    public $datosPaso2;

    //Variables paso 3
    public $select_evaluados = 'toda';
    public $areas;
    public $empleados;
    public $evaluados_areas;
    public $evaluados_manual;
    public $empleados_seleccionados;

    //verificacion objetivos y competencias
    public $hayEmpleadosSinCompetencias = false;
    public $totalEmpleadosSinCompetencias = 0;
    public $listaEmpleadosSinCompetencias;
    public $listaIDSinCompetencias;

    public $hayEmpleadosSinObjetivos = false;
    public $totalEmpleadosSinObjetivos = 0;
    public $listaEmpleadosSinObjetivos;
    public $listaIDSinObjetivos;

    public $hayEmpleadosObjetivosPendiente = false;
    public $totalEmpleadosObjetivosPendiente = 0;
    public $listaEmpleadosObjetivosPendiente;
    public $listaIDObjetivosPendiente;

    public $bloquear_evaluacion = true;

    //Variables paso 4
    public $evaluados;
    public $array_evaluados;
    public $array_evaluadores;
    public $array_porcentaje_evaluadores;
    public $colaboradores = [];

    public function updatedEmpleadosSeleccionados($value)
    {
        // dd($value);
        $this->empleados_seleccionados = $value;
        $this->tercerPaso();
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount()
    {
        // dd($a, $e);
        // $this->areas = $a;
        // $this->empleados = $e;

        // dd(
        //     $this->areas,
        //     $this->empleados
        // );
    }

    public function render()
    {
        return view('livewire.create-evaluacion-desempeno');
    }

    public function retroceder()
    {
        $this->paso--;
    }

    public function primerPaso()
    {
        if ($this->activar_objetivos == false) {
            $this->porcentaje_objetivos = 0;
        }
        if ($this->activar_competencias == false) {
            $this->porcentaje_competencias = 0;
        }

        $this->datosPaso1 = [
            'nombre' => $this->nombre_evaluacion,
            'descripcion' => $this->descripcion_evaluacion,
            'activar_objetivos' => $this->activar_objetivos,
            'porcentaje_objetivos' => $this->porcentaje_objetivos,
            'activar_competencias' => $this->activar_competencias,
            'porcentaje_competencias' => $this->porcentaje_competencias,
        ];

        $this->paso++;
    }

    public function segundoPaso()
    {
        // dd('2', $this->arreglo_periodos);
        $this->datosPaso2 = [];

        foreach ($this->arreglo_periodos as $key => $ap) {
            $this->datosPaso2[] =
                [
                    'nombre_evaluacion' => $ap['nombre_evaluacion'],
                    'fecha_inicio' => $ap['fecha_inicio'],
                    'fecha_fin' => $ap['fecha_fin'],
                    'habilitar' => $ap['habilitar']
                ];
        }
        // dd('datos', $this->datosPaso2);
        $this->paso++;
    }

    public function tercerPaso()
    {
        // dd($this->empleados_seleccionados);
        $evld = [];
        switch ($this->select_evaluados) {
            case 'toda':
                $ev_query = Empleado::getIDaltaAll();
                $evld = $ev_query->pluck('id');
                // dd($evld);
                break;

            case 'areas':
                $ev_query = Area::with('totalIDEmpleados')->find($this->evaluados_areas);
                $evld = $ev_query->totalIDEmpleados->pluck('id');
                // dd($evld);
                break;

            case 'manualmente':
                // $ev_query = Empleado::getIDaltaAll()->sortBy('name');

                // foreach ($this->empleados_seleccionados as $id_emp_sel) {
                //     $evld = $ev_query->find($id_emp_sel)->pluck('id');
                // }
                $evld = collect($this->empleados_seleccionados);

                // dd($evld);
                break;

            case 'grupos':
                // $this->empleados = Empleado::getIDaltaAll();
                break;
        }
        // dd($ev);
        // dd($evld);
        $this->asignarEvaluadoresAEvaluados($evld);

        $this->paso++;
    }

    public function cuartoPaso()
    {
        // dd($this->datosPaso1);
        // dd($this->datosPaso2);
        // dd($this->array_evaluados, $this->array_evaluadores, $this->array_porcentaje_evaluadores);

        $evaluacion = EvaluacionDesempeno::create([
            'nombre' => $this->datosPaso1['nombre'],
            'descripcion' => $this->datosPaso1['descripcion'],
            'activar_objetivos' => $this->datosPaso1['activar_objetivos'],
            'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'],
            'activar_competencias' => $this->datosPaso1['activar_competencias'],
            'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'],
            'tipo_periodo' => $this->periodo_evaluacion,
            'estatus' => 1,
        ]);

        foreach ($this->datosPaso2 as $key => $p) {
            // dd();
            if (!empty($p['nombre_evaluacion'])) {
                // dd('entra');
                PeriodosEvaluacionDesempeno::create([
                    'evaluacion_desempeno_id' => $evaluacion->id,
                    'nombre_evaluacion' => $p['nombre_evaluacion'],
                    'fecha_inicio' => $p['fecha_inicio'],
                    'fecha_fin' => $p['fecha_fin'],
                    'habilitado' => $p['habilitar'],
                ]);
            }
        }

        foreach ($this->array_evaluados as $key => $evaluado) {
            // dd($evaluado);
            $evaluado = EvaluadosEvaluacionDesempeno::create(
                [
                    'evaluacion_desempeno_id' => $evaluacion->id,
                    'evaluado_desempeno_id' => $evaluado['id'],
                ]
            );
            if ($evaluacion->activar_objetivos) {
                foreach ($this->array_evaluadores[$key]['evaluador_objetivos'] as $subkey => $evaluador) {
                    // dd($this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_objetivos'][$subkey]);
                    EvaluadoresEvaluacionObjetivosDesempeno::create([
                        'evaluado_desempeno_id' => $evaluado->id,
                        'evaluador_desempeno_id' => $evaluador,
                        'porcentaje_objetivos' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_objetivos'][$subkey],
                    ]);
                }
            }
            if ($evaluacion->activar_competencias) {
                foreach ($this->array_evaluadores[$key]['evaluador_competencias'] as $subkey => $evaluador) {
                    // dd($evaluador);
                    EvaluadoresEvaluacionCompetenciasDesempeno::create([
                        'evaluado_desempeno_id' => $evaluado->id,
                        'evaluador_desempeno_id' => $evaluador,
                        'porcentaje_competencias' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_competencias'][$subkey],
                    ]);
                }
            }
        }

        $this->crearCuestionario($evaluacion);

        return redirect(route('admin.rh.evaluaciones-desempeño.index'));
    }

    public function crearCuestionario($evaluacion)
    {
        // dd($evaluacion);
        $empleados = Empleado::getIDaltaAll();

        foreach ($evaluacion->evaluados as $evaluado) {
            if ($evaluacion->activar_objetivos) {
                $obj_per = $empleados->find($evaluado->evaluado_desempeno_id)->objetivosPeriodo($this->periodo_evaluacion);
                foreach ($evaluado->evaluadoresObjetivos as $key => $evlr_obj) {
                    $batch_objetivo = [];
                    foreach ($obj_per as $obj) {
                        $batch_objetivo[] =
                            [
                                'objetivo' => $obj->objetivo->nombre,
                                'descripcion_objetivo' => $obj->objetivo->descripcion_meta,
                                'KPI' => $obj->objetivo->KPI,
                                'tipo_objetivo' => $obj->objetivo->tipo->nombre,
                                'unidad_objetivo' => $obj->objetivo->metrica->definicion,
                                'valor_minimo_unidad_objetivo' => $obj->objetivo->metrica->valor_minimo,
                                'valor_maximo_unidad_objetivo' => $obj->objetivo->metrica->valor_maximo,
                                'evaluacion_desempeno_id' => $evaluado->evaluacion_desempeno_id,
                                'evaluado_desempeno_id' => $evaluado->id,
                                'evaluador_desempeno_id' => $evlr_obj->id,
                                'calificacion_objetivo' => null,
                                'estatus_calificado' => false,
                            ];
                    }
                    CuestionarioObjetivoEvDesempeno::insert($batch_objetivo);
                }
            }

            if ($evaluacion->activar_competencias) {
                $comp_per = $empleados->find($evaluado->evaluado_desempeno_id)->puestoRelacionado->competencias;
                foreach ($evaluado->evaluadoresCompetencias as $key => $evlr_comp) {
                    $batch_competencia = [];
                    foreach ($comp_per as $comp) {
                        // dd($comp->nivel_esperado, $comp->competencia, $comp->competencia->tipo);
                        $batch_competencia[] =
                            [
                                'competencia' => $comp->competencia->nombre,
                                'descripcion_competencia' => $comp->competencia->descripcion,
                                'tipo_competencia' => $comp->competencia->tipo->nombre,
                                'nivel_esperado' => $comp->nivel_esperado,
                                'evaluacion_desempeno_id' => $evaluado->evaluacion_desempeno_id,
                                'evaluado_desempeno_id' => $evaluado->id,
                                'evaluador_desempeno_id' => $evlr_comp->id,
                                'calificacion_competencia' => null,
                                'estatus_calificado' => false,
                            ];
                    }
                    CuestionarioCompetenciaEvDesempeno::insert($batch_competencia);
                }
            }
        }
    }

    public function seleccionPeriodo($periodo, $valor)
    {
        // dd($periodo, $valor);
        $this->arreglo_periodos = [];
        $this->periodo_evaluacion = $periodo;
        switch ($periodo) {
            case 'mensual':
                $this->mensual = $valor;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anualmente = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 12; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                // dd($this->arreglo_periodos[0]);
                break;

            case 'bimestral':
                $this->mensual = false;
                $this->bimestral = $valor;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anualmente = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 6; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'trimestral':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = $valor;
                $this->semestral = false;
                $this->anualmente = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 4; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'semestral':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = $valor;
                $this->anualmente = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 2; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'anualmente':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anualmente = $valor;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 1; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'abierta':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anualmente = false;
                $this->abierta = $valor;

                if ($valor) {
                    for ($i = 1; $i <= 1; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            default:
                # code...
                //dd($this->arreglo_periodos);
                break;
        }
    }

    public function seleccionarEvaluados($valor)
    {
        // dd($valor);
        switch ($valor) {
            case 'toda':
                $this->select_evaluados = $valor;
                $this->areas = null;
                $this->empleados = null;

                break;

            case 'areas':
                $this->areas = Area::getIdNameAll()->sortBy('area');
                $this->empleados = null;
                $this->select_evaluados = $valor;

                break;

            case 'manualmente':
                $this->empleados = Empleado::getIDaltaAll()->sortBy('name');
                $this->areas = null;
                $this->select_evaluados = $valor;

                break;

            case 'grupos':
                // $this->empleados = Empleado::getIDaltaAll();
                break;
        }
    }

    public function asignarEvaluadoresAEvaluados($evaluados)
    {
        $this->array_evaluados = [];

        $emps = Empleado::select(
            'id',
            'name',
            'area_id',
            'supervisor_id',
            'puesto_id',
            'foto'
        )->with(['objetivos', 'children:id,name', 'supervisor:id,name', 'area:id,area', 'puestoRelacionado:id,puesto'])->where('estatus', 'alta')->whereNull('deleted_at')->get();

        foreach ($emps as $emp) {
            $this->colaboradores[] =
                [
                    'id' => $emp->id,
                    'name' => $emp->name,
                    // 'area' => $emp->area->area,
                ];
        }

        foreach ($evaluados as $key => $id_evaluado) {
            $eva = $emps->find($id_evaluado);
            $this->array_evaluados[$key] =
                [
                    'id' => $eva->id,
                    'name' => $eva->name,
                    'avatar' => $eva->avatar,
                    'area' => $eva->area->area,
                    'competencias' => $eva->competencias_asignadas,
                    'objetivos' => $eva->objetivos_asignados
                ];

            $this->listaEmpleadosSinCompetencias = collect();
            $this->listaIDSinCompetencias = collect();
            $this->listaEmpleadosSinObjetivos = collect();
            $this->listaIDSinObjetivos = collect();
            $this->listaEmpleadosObjetivosPendiente = collect();
            $this->listaIDObjetivosPendiente = collect();
            $this->totalEmpleadosSinCompetencias = 0;
            $this->totalEmpleadosSinObjetivos = 0;
            $this->totalEmpleadosObjetivosPendiente = 0;
            $this->hayEmpleadosSinCompetencias = false;
            $this->hayEmpleadosSinObjetivos = false;
            $this->hayEmpleadosObjetivosPendiente = false;
            // dd($this->array_evaluados);
            foreach ($this->array_evaluados as $evaluadoL) {
                // dd($evaluadoL['competencias']);
                if ($evaluadoL['competencias'] == 0) {
                    $this->hayEmpleadosSinCompetencias = true;
                    $this->totalEmpleadosSinCompetencias++;
                    $this->listaEmpleadosSinCompetencias->push(['name' => $evaluadoL['name'], 'avatar' => $evaluadoL['avatar']]);
                    $this->listaIDSinCompetencias->push($evaluadoL['id']);
                    // dd($this->listaEmpleadosSinCompetencias);
                } elseif ($evaluadoL['objetivos']['cuenta'] == 0) {
                    $this->hayEmpleadosSinObjetivos = true;
                    $this->totalEmpleadosSinObjetivos++;
                    $this->listaEmpleadosSinObjetivos->push(['name' => $evaluadoL['name'], 'avatar' => $evaluadoL['avatar']]);
                    $this->listaIDSinObjetivos->push($evaluadoL['id']);
                    // dd($this->listaEmpleadosSinObjetivos);
                } elseif ($evaluadoL['objetivos']['pendientes'] == true) {
                    $this->hayEmpleadosObjetivosPendiente = true;
                    $this->totalEmpleadosObjetivosPendiente++;
                    $this->listaEmpleadosObjetivosPendiente->push(['name' => $evaluadoL['name'], 'avatar' => $evaluadoL['avatar']]);
                    $this->listaIDObjetivosPendiente->push($evaluadoL['id']);
                    // dd($this->listaEmpleadosObjetivosPendiente);
                }
            }

            if ($this->totalEmpleadosSinCompetencias > 0) {
                $this->alert('warning', 'Sin Competencias', [
                    'position' => 'center',
                    'timer' => '600000',
                    'toast' => false,
                    'text' => 'Existen colaboradores sin competencias asignadas, no podra crear la evaluación si los colaboradores no tienen competencias para evaluar',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);
            } elseif ($this->totalEmpleadosSinObjetivos > 0) {
                $this->alert('warning', 'Sin Objetivos', [
                    'position' => 'center',
                    'timer' => '600000',
                    'toast' => false,
                    'text' => 'Existen colaboradores sin objetivos asignados, no podra crear la evaluación si los colaboradores no tienen objetivos para evaluar',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);
            } elseif ($this->totalEmpleadosObjetivosPendiente > 0) {
                $this->alert('warning', 'Objetivos Pendientes', [
                    'position' => 'center',
                    'timer' => '600000',
                    'toast' => false,
                    'text' => 'Existen colaboradores con objetivos asignados pendientes de revisar, no podra crear la evaluación si los colaboradores tienen objetivos con estatus pendientes.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);
            } else {
                $this->bloquear_evaluacion = false;
            }

            if ($this->activar_objetivos == true && $this->activar_competencias == true) {

                $this->array_evaluadores[$key] = [
                    'evaluador_objetivos' => [''],
                    'evaluador_competencias' => ['']
                ];

                $this->array_porcentaje_evaluadores[$key] =
                    [
                        'porcentaje_evaluador_objetivos' => [''],
                        'porcentaje_evaluador_competencias' => ['']
                    ];
            } elseif ($this->activar_objetivos == true && $this->activar_competencias == false) {

                $this->array_evaluadores[] =
                    [
                        'evaluador_objetivos' => ['']
                    ];

                $this->array_porcentaje_evaluadores =  [
                    'porcentaje_evaluador_objetivos' => [''],
                ];
            } elseif ($this->activar_objetivos == false && $this->activar_competencias == true) {

                $this->array_evaluadores[] =
                    [
                        'evaluador_competencias' => ['']
                    ];

                $this->array_porcentaje_evaluadores =  [
                    'porcentaje_evaluador_competencias' => ['']
                ];
            }
        }
        // dd($this->array_evaluados, $this->array_evaluadores);
    }

    public function agregarEvaluadorObjetivos($posicion)
    {
        $this->array_evaluadores[$posicion]['evaluador_objetivos'][] = '';
        $this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_objetivos'][] = '';
    }

    public function removerEvaluadorObjetivos($posicion, $subposicion)
    {
        unset($this->array_evaluadores[$posicion]['evaluador_objetivos'][$subposicion]);
        $this->array_evaluadores = array_values($this->array_evaluadores);

        unset($this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_objetivos'][$subposicion]);
        $this->array_porcentaje_evaluadores = array_values($this->array_porcentaje_evaluadores);
    }

    public function agregarEvaluadorCompetencias($posicion)
    {
        $this->array_evaluadores[$posicion]['evaluador_competencias'][] = '';
        $this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_competencias'][] = '';
    }

    public function removerEvaluadorCompetencias($posicion, $subposicion)
    {
        unset($this->array_evaluadores[$posicion]['evaluador_competencias'][$subposicion]);
        $this->array_evaluadores = array_values($this->array_evaluadores);

        unset($this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_competencias'][$subposicion]);
        $this->array_porcentaje_evaluadores = array_values($this->array_porcentaje_evaluadores);
    }

    public function borrador()
    {
        switch ($this->paso) {
            case 1:
                if (!empty($this->nombre_evaluacion)) {
                    $this->primerPaso();
                    // dd($this->datosPaso1);
                    $evaluacion = EvaluacionDesempeno::create([
                        'nombre' => $this->datosPaso1['nombre'],
                        'descripcion' => $this->datosPaso1['descripcion'],
                        'activar_objetivos' => $this->datosPaso1['activar_objetivos'],
                        'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'],
                        'activar_competencias' => $this->datosPaso1['activar_competencias'],
                        'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'],
                        'tipo_periodo' => null,
                        'estatus' => 0,
                    ]);
                } else {
                    //alerta
                    dd('alerta');
                }
                return redirect(route('admin.rh.evaluaciones-desempeño.index'));
                break;

            case 2:
                $this->primerPaso();

                $evaluacion = EvaluacionDesempeno::create([
                    'nombre' => $this->datosPaso1['nombre'],
                    'descripcion' => $this->datosPaso1['descripcion'],
                    'activar_objetivos' => $this->datosPaso1['activar_objetivos'],
                    'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'],
                    'activar_competencias' => $this->datosPaso1['activar_competencias'],
                    'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'],
                    'tipo_periodo' => null,
                    'estatus' => 0,
                ]);

                if (!empty($this->periodo_evaluacion)) {
                    $evaluacion->update([
                        'tipo_periodo' => $this->periodo_evaluacion,
                    ]);

                    $this->segundoPaso();

                    foreach ($this->datosPaso2 as $key => $p) {
                        if (!empty($p['nombre_evaluacion'])) {
                            PeriodosEvaluacionDesempeno::create([
                                'evaluacion_desempeno_id' => $evaluacion->id,
                                'nombre_evaluacion' => $p['nombre_evaluacion'],
                                'fecha_inicio' => $p['fecha_inicio'],
                                'fecha_fin' => $p['fecha_fin'],
                                'habilitado' => $p['habilitar'],
                            ]);
                        }
                    }
                }
                return redirect(route('admin.rh.evaluaciones-desempeño.index'));
                break;

            case 3:
                $this->primerPaso();

                $evaluacion = EvaluacionDesempeno::create([
                    'nombre' => $this->datosPaso1['nombre'],
                    'descripcion' => $this->datosPaso1['descripcion'],
                    'activar_objetivos' => $this->datosPaso1['activar_objetivos'],
                    'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'],
                    'activar_competencias' => $this->datosPaso1['activar_competencias'],
                    'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'],
                    'tipo_periodo' => null,
                    'estatus' => 0,
                ]);

                if (!empty($this->periodo_evaluacion)) {
                    $evaluacion->update([
                        'tipo_periodo' => $this->periodo_evaluacion,
                    ]);

                    $this->segundoPaso();

                    foreach ($this->datosPaso2 as $key => $p) {
                        if (!empty($p['nombre_evaluacion'])) {
                            PeriodosEvaluacionDesempeno::create([
                                'evaluacion_desempeno_id' => $evaluacion->id,
                                'nombre_evaluacion' => $p['nombre_evaluacion'],
                                'fecha_inicio' => $p['fecha_inicio'],
                                'fecha_fin' => $p['fecha_fin'],
                                'habilitado' => $p['habilitar'],
                            ]);
                        }
                    }
                }

                return redirect(route('admin.rh.evaluaciones-desempeño.index'));
                break;

            case 4:
                $this->primerPaso();

                $evaluacion = EvaluacionDesempeno::create([
                    'nombre' => $this->datosPaso1['nombre'],
                    'descripcion' => $this->datosPaso1['descripcion'],
                    'activar_objetivos' => $this->datosPaso1['activar_objetivos'],
                    'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'],
                    'activar_competencias' => $this->datosPaso1['activar_competencias'],
                    'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'],
                    'tipo_periodo' => null,
                    'estatus' => 0,
                ]);

                if (!empty($this->periodo_evaluacion)) {
                    $evaluacion->update([
                        'tipo_periodo' => $this->periodo_evaluacion,
                    ]);

                    $this->segundoPaso();

                    foreach ($this->datosPaso2 as $key => $p) {
                        if (!empty($p['nombre_evaluacion'])) {
                            PeriodosEvaluacionDesempeno::create([
                                'evaluacion_desempeno_id' => $evaluacion->id,
                                'nombre_evaluacion' => $p['nombre_evaluacion'],
                                'fecha_inicio' => $p['fecha_inicio'],
                                'fecha_fin' => $p['fecha_fin'],
                                'habilitado' => $p['habilitar'],
                            ]);
                        }
                    }
                }

                foreach ($this->array_evaluados as $key => $evaluado) {
                    // dd($evaluado);
                    $evaluado = EvaluadosEvaluacionDesempeno::create(
                        [
                            'evaluacion_desempeno_id' => $evaluacion->id,
                            'evaluado_desempeno_id' => $evaluado['id'],
                        ]
                    );

                    foreach ($this->array_evaluadores[$key]['evaluador_objetivos'] as $subkey => $evaluador) {
                        if (!empty($evaluador)) {
                            EvaluadoresEvaluacionObjetivosDesempeno::create([
                                'evaluado_desempeno_id' => $evaluado->id,
                                'evaluador_desempeno_id' => $evaluador,
                                'porcentaje_objetivos' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_objetivos'][$subkey],
                            ]);
                        }
                    }
                    foreach ($this->array_evaluadores[$key]['evaluador_competencias'] as $subkey => $evaluador) {
                        if (!empty($evaluador)) {
                            EvaluadoresEvaluacionObjetivosDesempeno::create([
                                'evaluado_desempeno_id' => $evaluado->id,
                                'evaluador_desempeno_id' => $evaluador,
                                'porcentaje_objetivos' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_competencias'][$subkey],
                            ]);
                        }
                    }
                }

                return redirect(route('admin.rh.evaluaciones-desempeño.index'));
                break;

            default:
                return redirect(route('admin.rh.evaluaciones-desempeño.index'));
                break;
        }
    }
}
