<?php

namespace App\Livewire;

use App\Mail\RH\Evaluaciones\NotificacionEvaluador;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\RH\CatalogoRangosObjetivos;
use App\Models\RH\Competencia;
use App\Models\RH\Ev360ParametrosObjetivos;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionCompetencia;
use App\Models\RH\EvaluacionObjetivo;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\GruposEvaluado;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoRespuesta;
use App\Models\RH\TipoCompetencia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class MultiStepForm extends Component
{
    use LivewireAlert;

    //TABLA
    use WithPagination;

    // Properties for all steps
    public $showTable = false;

    public $search = '';

    public $perPage = 10;

    public $filter = 1;

    public $selected = [];

    public $sendEmail = true;

    // Properties for step 1
    public $showContentTable = false;

    public $nombre;

    public $descripcion;

    public $includeCompetencias;

    public $includeObjetivos;

    public $showPesoGeneralCompetencias = false;

    public $pesoGeneralCompetencias = 0;

    public $showPesoGeneralObjetivos = false;

    public $pesoGeneralObjetivos = 0;

    public $sumaTotalPesoGeneral;

    public $catalogoObjetivos = '';

    public $time_elapsed_secs;

    // Properties for step 2
    protected $listeners = ['grupoEvaluadosSaved' => 'render'];

    public $evaluados_objetivo;

    public $by_manual;

    public $by_area;

    public $habilitarSelectManual = false;

    public $habilitarSelectAreas = false;

    public $listaEvaluados;

    // Properties for step 3
    public $typeEvaluation = 360;

    public $evaluado_por_jefe = true;

    public $evaluado_por_misma_area = true;

    public $evaluado_por_equipo_a_cargo = true;

    public $autoevaluacion = true;

    public $pesoEvaluacionJefe = 25;

    public $pesoEvaluacionArea = 25;

    public $pesoEvaluacionEquipo = 25;

    public $pesoAutoevaluacion = 25;

    public $sumaTotalPeso;

    public $aceptado = true;

    // Properties for step 4
    public $periodos = [];

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

    public $totalSteps = 5;

    public $currentStep = 1;

    public $hoy;

    public $bloquear_evaluacion = true;

    public function mount()
    {
        $this->hoy = Carbon::now();
        $this->currentStep = 1;
        $this->periodos = [[
            'fecha_inicio' => $this->hoy->format('Y-m-d'),
            'fecha_fin' => $this->hoy->addMonth()->format('Y-m-d'),
        ]];
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }

    public function render()
    {
        $evaluacion = new Evaluacion;
        $areas = Area::getAll();
        $empleados = Empleado::getIdNameAll();
        $grupos_evaluados = GruposEvaluado::getAll();
        $catalogo_rangos_objetivos = CatalogoRangosObjetivos::get();

        $competencias = Competencia::search($this->search)->orderByDesc('id')->cursorPaginate($this->perPage);
        $tipos = TipoCompetencia::getAll();

        return view('livewire.multi-step-form', ['evaluacion' => $evaluacion, 'areas' => $areas, 'empleados' => $empleados, 'grupos_evaluados' => $grupos_evaluados, 'competencias' => $competencias, 'tipos' => $tipos, 'catalogo_rangos_objetivos' => $catalogo_rangos_objetivos]);
    }

    public function habilitarSelectAlternativo()
    {
        if ($this->evaluados_objetivo == 'manual') {
            $this->habilitarSelectManual = true;
            $this->habilitarSelectAreas = false;
        } elseif ($this->evaluados_objetivo == 'area') {
            $this->habilitarSelectAreas = true;
            $this->habilitarSelectManual = false;
        } else {
            $this->habilitarSelectManual = false;
            $this->habilitarSelectAreas = false;
        }
    }

    public function restarGrados($tipo)
    {
        $valueToAdd = $this->typeEvaluation + 90;
        $valueToSubtract = $this->typeEvaluation - 90;

        switch ($tipo) {
            case 'jefe_inmediato':
                $this->typeEvaluation = $this->evaluado_por_jefe ? $valueToAdd : $valueToSubtract;
                break;
            case 'equipo_a_cargo':
                $this->typeEvaluation = $this->evaluado_por_equipo_a_cargo ? $valueToAdd : $valueToSubtract;
                break;
            case 'misma_area':
                $this->typeEvaluation = $this->evaluado_por_misma_area ? $valueToAdd : $valueToSubtract;
                break;
            case 'autoevaluacion':
                $this->typeEvaluation = $this->autoevaluacion ? $valueToAdd : $valueToSubtract;
                break;
        }
    }

    public function removePeriodo($index)
    {
        if (count($this->periodos) > 1) {
            unset($this->periodos[$index]);
        }
    }

    public function addPeriodo()
    {
        $this->periodos[] = [
            'fecha_inicio' => $this->hoy->format('Y-m-d'),
            'fecha_fin' => $this->hoy->addMonth()->format('Y-m-d'),
        ];
    }

    public function increaseStep()
    {

          // Verificar si el peso general por competencias es válido (≤ 100)
          if ($this->pesoGeneralCompetencias > 100) {
            $this->alert('error', 'Excede el peso general por competencias!');
            return;
        }

        // Verificar si el peso general por objetivos es válido (≤ 100)
        if ($this->pesoGeneralObjetivos > 100) {
            $this->alert('error', 'Excede el peso general por objetivos!');
            return;
        }

        // Verificar si ambos pesos han sido completados y no son insuficientes
        if ($this->pesoGeneralCompetencias < 100 && $this->pesoGeneralObjetivos === 0) {
            $this->alert('error', 'Falta completar el peso general por objetivos!');
            return;
        }

        if ($this->pesoGeneralObjetivos < 100 && $this->pesoGeneralCompetencias === 0) {
            $this->alert('error', 'Falta completar el peso general por competencias!');
            return;
        }

        // Calcular la suma total de los pesos generales
        $this->sumaTotalPesoGeneral = ((float) $this->pesoGeneralCompetencias ?: 0) + ((float) $this->pesoGeneralObjetivos ?: 0);


        // Verificar si la suma total es igual a 100
        if ($this->sumaTotalPesoGeneral === 100) {
            $this->resetErrorBag();
            $this->validateData();
            $this->dispatch('increaseStep');
            $this->currentStep++;
            if ($this->currentStep == 3) {
                $this->listaEvaluados = $this->obtenerEvaluadosConEvaluadores($this->evaluados_objetivo);
                // dd($this->listaEvaluados[0]['evaluado']);
            }
            if ($this->currentStep == 4) {
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
                foreach ($this->listaEvaluados as $evaluadoL) {
                    // dd($evaluadoL['evaluado']);
                    if ($evaluadoL['evaluado']['competencias_asignadas'] == 0) {
                        // dd($evaluadoL['evaluado']['id']);
                        $this->hayEmpleadosSinCompetencias = true;
                        $this->totalEmpleadosSinCompetencias++;
                        $this->listaEmpleadosSinCompetencias->push($evaluadoL['evaluado']['name']);
                        $this->listaIDSinCompetencias->push($evaluadoL['evaluado']['id']);
                    } elseif ($evaluadoL['evaluado']['objetivos_asignados']['cuenta'] == 0) {
                        $this->hayEmpleadosSinObjetivos = true;
                        $this->totalEmpleadosSinObjetivos++;
                        $this->listaEmpleadosSinObjetivos->push($evaluadoL['evaluado']['name']);
                        $this->listaIDSinObjetivos->push($evaluadoL['evaluado']['id']);
                    } elseif ($evaluadoL['evaluado']['objetivos_asignados']['pendientes'] == true) {
                        $this->hayEmpleadosObjetivosPendiente = true;
                        $this->totalEmpleadosObjetivosPendiente++;
                        $this->listaEmpleadosObjetivosPendiente->push($evaluadoL['evaluado']['name']);
                        $this->listaIDObjetivosPendiente->push($evaluadoL['evaluado']['id']);
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
            }

            if ($this->currentStep > $this->totalSteps) {
                $this->currentStep = $this->totalSteps;
            }
        } else {
            $this->alert('error', 'La suma total no alcanza 100. Verifique que ambos valores sumen 100.!');
            return;
        }
    }

    public function redirigirCompetencias()
    {
        // $this->dispatch('openNewTab', ['url' => route('admin.ev360-competencias-por-puesto.index')]);

        // Define the URL you want to redirect to
        // $url = route('admin.ev360-competencias-por-puesto.index');
        // $this->dispatch('openNewTab', ['url' => $url]);

        $this->decreaseStep();
        // $this->openNewTab();
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->dispatch('decreaseStep');
        $this->currentStep--;
        if ($this->currentStep == 3) {
            $this->listaEvaluados = $this->obtenerEvaluadosConEvaluadores($this->evaluados_objetivo);
        }
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validateStepOne();
        } elseif ($this->currentStep == 2) {
            $this->validateStepTwo();
        } elseif ($this->currentStep == 3) {
            $this->validateStepThree();
        }
    }

    public function validateStepOne()
    {
        $this->sumaTotalPesoGeneral = 0;

        // Define common validation rules
        $commonRules = [
            'nombre' => 'required|string|max:250',
            'descripcion' => 'nullable|string|max:1000',
        ];

        if ($this->includeCompetencias && $this->includeObjetivos) {
            // If both competencias and objetivos are included
            $this->sumaTotalPesoGeneral = $this->pesoGeneralCompetencias + $this->pesoGeneralObjetivos;
            $this->validate(array_merge($commonRules, [
                //'pesoGeneralCompetencias' => 'required|numeric|min:100|max:100',
                'pesoGeneralObjetivos' => 'required|numeric',
                'catalogoObjetivos' => 'required|numeric',
                //'sumaTotalPesoGeneral' => 'required|numeric|in:100',
            ]));
        } elseif ($this->includeCompetencias && ! $this->includeObjetivos) {
            // If only competencias are included
            $this->sumaTotalPesoGeneral = $this->pesoGeneralCompetencias;
            $this->pesoGeneralObjetivos = 0;
            $this->validate(array_merge($commonRules, [
                // 'pesoGeneralCompetencias' => 'required|numeric|in:100',
                // 'sumaTotalPesoGeneral' => 'required|numeric|in:100',
            ]));
        } elseif (! $this->includeCompetencias && $this->includeObjetivos) {
            // If only objetivos are included
            $this->sumaTotalPesoGeneral = $this->pesoGeneralObjetivos;
            $this->pesoGeneralCompetencias = 0;
            $this->validate(array_merge($commonRules, [
                //'pesoGeneralObjetivos' => 'required|numeric|in:100',
                'catalogoObjetivos' => 'required|numeric',
                //'sumaTotalPesoGeneral' => 'required|numeric|in:100',
            ]));
        } else {
            // If neither competencias nor objetivos are included
            $this->validate(array_merge($commonRules, [
                'includeCompetencias' => 'accepted',
                'includeObjetivos' => 'accepted',
            ]));
        }
    }

    public function validateStepTwo()
    {
        $rules = [
            'evaluados_objetivo' => 'required',
        ];

        $messages = [
            'evaluados_objetivo.required' => 'El campo público objetivo es requerido',
        ];

        if ($this->evaluados_objetivo == 'manual') {
            $rules['by_manual'] = 'required';
            $messages['by_manual.required'] = 'El campo de selección manual por empleados es requerido';
        } elseif ($this->evaluados_objetivo == 'area') {
            $rules['by_area'] = 'required';
            $messages['by_area.required'] = 'El campo de selección por área es requerido';
        }

        $this->validate($rules, $messages);
    }

    public function validateStepThree()
    {
        $this->sumaTotalPeso = 0;

        $rules = [];
        $messages = [];

        // Validation for evaluado options
        if (! $this->evaluado_por_jefe && ! $this->evaluado_por_misma_area && ! $this->evaluado_por_equipo_a_cargo && ! $this->autoevaluacion) {
            $rules += [
                'evaluado_por_jefe' => 'accepted',
                'evaluado_por_misma_area' => 'accepted',
                'evaluado_por_equipo_a_cargo' => 'accepted',
                'autoevaluacion' => 'accepted',
            ];

            $messages += [
                'evaluado_por_jefe.accepted' => 'Debes de incluir al menos una opción',
                'evaluado_por_misma_area.accepted' => 'Debes de incluir al menos una opción',
                'evaluado_por_equipo_a_cargo.accepted' => 'Debes de incluir al menos una opción',
                'autoevaluacion.accepted' => 'Debes de incluir al menos una opción',
            ];
        }

        // Validation for each evaluado option
        $evaluadoOptions = [
            'evaluado_por_jefe' => 'pesoEvaluacionJefe',
            'evaluado_por_misma_area' => 'pesoEvaluacionArea',
            'evaluado_por_equipo_a_cargo' => 'pesoEvaluacionEquipo',
            'autoevaluacion' => 'pesoAutoevaluacion',
        ];

        foreach ($evaluadoOptions as $option => $pesoField) {
            if ($this->$option) {
                $this->sumaTotalPeso += $this->$pesoField;

                $rules[$pesoField] = 'required|numeric|max:100|min:0';

                $messages += [
                    "$pesoField.required" => 'El peso es requerido',
                    "$pesoField.max" => 'El peso máximo es 100%',
                    "$pesoField.min" => 'El peso mínimo es 0%',
                ];
            }
        }

        // Validate total sum of weights
        $rules['sumaTotalPeso'] = 'numeric|max:100|min:100';
        $messages += [
            'sumaTotalPeso.max' => 'El peso total debe ser 100%, actual: '.$this->sumaTotalPeso.'%',
            'sumaTotalPeso.min' => 'El peso total debe ser 100%, actual: '.$this->sumaTotalPeso.'%',
        ];

        $this->validate($rules, $messages);
    }

    public function validateStepFour()
    {
        $this->validate([
            'periodos' => 'required|array|min:1',
            //"periodos.*"  => "required|date|distinct|min:2"
        ]);
    }

    public function draftEvaluation()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validateStepFour();
        }
    }

    public function activateEvaluation()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validateStepFour();
        }
        foreach ($this->periodos as $idx => $periodo) {
            $estatus = Evaluacion::ACTIVE;
            // if ($idx > 0) {
            //     $estatus = Evaluacion::DRAFT;
            // }
            $this->createEvaluation(
                $idx,
                $this->nombre.'-'.($idx + 1),
                $this->descripcion,
                $estatus,
                $this->evaluados_objetivo,
                $this->autoevaluacion,
                $this->evaluado_por_jefe,
                $this->evaluado_por_equipo_a_cargo,
                $this->evaluado_por_misma_area,
                $periodo['fecha_inicio'],
                $periodo['fecha_fin']
            );
        }
        $this->increaseStep();
    }

    public function createEvaluation($idx, $nombre, $descripcion, $estatus, $evaluados_objetivo, $autoevaluacion, $evaluado_por_jefe, $evaluado_por_equipo_a_cargo, $evaluado_por_misma_area, $fecha_inicio, $fecha_fin)
    {
        $currentUserEmpleadoId = User::getCurrentUser()->empleado->id;

        switch ($evaluados_objetivo) {
            case 'all':
                // $evaluados = Empleado::getAltaEmpleadosEvaluaciones()->pluck('id')->toArray();
                $evaluados = DB::table('empleados')
                    ->select('empleados.id', 'empleados.name', 'empleados.email', 'empleados.area_id', 'empleados.puesto_id')
                    ->join('areas', 'empleados.area_id', '=', 'areas.id')
                    ->join('puestos', 'empleados.puesto_id', '=', 'puestos.id')
                    ->select(
                        'empleados.id',
                        'empleados.name',
                        'empleados.email',
                        'empleados.area_id',
                        'empleados.puesto_id',
                        'areas.id as area_id',
                        'areas.area',
                        'puestos.id as puesto_id',
                        'puestos.puesto'
                    )
                    ->where('empleados.estatus', 'alta')
                    ->whereNull('empleados.deleted_at')
                    ->pluck('empleados.id')
                    ->toArray();
                break;
            case 'area':
                // $evaluados = Empleado::getAltaEmpleadosEvaluaciones()->where('area_id', $this->by_area)->pluck('id')->toArray();
                $evaluados = DB::table('empleados')
                    ->select('empleados.id', 'empleados.name', 'empleados.email', 'empleados.area_id', 'empleados.puesto_id')
                    ->join('areas', 'empleados.area_id', '=', 'areas.id')
                    ->join('puestos', 'empleados.puesto_id', '=', 'puestos.id')
                    ->select(
                        'empleados.id',
                        'empleados.name',
                        'empleados.email',
                        'empleados.area_id',
                        'empleados.puesto_id',
                        'areas.id as area_id',
                        'areas.area',
                        'puestos.id as puesto_id',
                        'puestos.puesto'
                    )
                    ->where('empleados.estatus', 'alta')
                    ->whereNull('empleados.deleted_at')
                    ->where('empleados.area_id', $this->by_area)
                    ->pluck('empleados.id')
                    ->toArray();
                break;
            case 'manual':
                $evaluados = $this->by_manual;
                break;
            default:
                $evaluados = GruposEvaluado::find($evaluados_objetivo)->empleados->pluck('id')->toArray();
                break;
        }

        $evaluacionData = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'estatus' => $estatus,
            'evaluados_objetivo' => $evaluados_objetivo,
            'autor_id' => $currentUserEmpleadoId,
            'autoevaluacion' => $autoevaluacion,
            'evaluado_por_jefe' => $evaluado_por_jefe,
            'evaluado_por_equipo_a_cargo' => $evaluado_por_equipo_a_cargo,
            'evaluado_por_misma_area' => $evaluado_por_misma_area,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'peso_autoevaluacion' => $this->pesoAutoevaluacion,
            'peso_jefe_inmediato' => $this->pesoEvaluacionJefe,
            'peso_equipo' => $this->pesoEvaluacionEquipo,
            'peso_area' => $this->pesoEvaluacionArea,
            'peso_general_competencias' => $this->pesoGeneralCompetencias,
            'peso_general_objetivos' => $this->pesoGeneralObjetivos,
            'include_competencias' => $this->includeCompetencias ?? false,
            'include_objetivos' => $this->includeObjetivos ?? false,
        ];

        $evaluacion = Evaluacion::create($evaluacionData);

        $evaluados_puesto = Empleado::whereIn('id', $evaluados)
            ->pluck('id')
            ->toArray();

        $evaluacion->evaluados()->sync($evaluados_puesto);

        foreach ($this->listaEvaluados as $listaEvaluado) {
            $this->relacionarEvaluadoConEvaluadores($evaluacion, $listaEvaluado);
        }

        if ($estatus == Evaluacion::ACTIVE) {
            foreach ($evaluacion->evaluados as $evaluado) {
                $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)->get();
                $this->crearCuestionario($evaluacion, $evaluado->id, $evaluadores, $this->includeCompetencias, $this->includeObjetivos);
            }
        }

        //Se asignan los valores que tendra la evaluacion
        $catalogo = CatalogoRangosObjetivos::with('rangos')->findOrFail($this->catalogoObjetivos);

        foreach ($catalogo->rangos as $r) {
            Ev360ParametrosObjetivos::create([
                'evaluacion_id' => $evaluacion->id,
                'parametro' => $r->parametro,
                'valor' => $r->valor,
                'color' => $r->color,
                'descripcion' => $r->descripcion,
            ]);
        }

        if ($idx == 0 && $this->sendEmail) {
            $evaluacion->update(['email_sended' => true]);
            $this->enviarCorreoAEvaluadores($evaluacion, $evaluadores);
        }
    }

    public function relacionarEvaluadoConEvaluadores($evaluacion, $listaEvaluado)
    {
        // $empleado = Empleado::with('children', 'supervisor')->find(intval($evaluado));
        // $evaluadores = collect();
        // $evaluacion = Evaluacion::with('competencias')->find($evaluacion->id);

        // if ($evaluacion->autoevaluacion) {
        //     $evaluadores->push(['id' => intval($empleado->id), 'peso' => $this->pesoAutoevaluacion, 'tipo' => EvaluadoEvaluador::AUTOEVALUACION]);
        // }
        // if ($evaluacion->evaluado_por_jefe) {
        //     if ($empleado->supervisor) {
        //         $evaluadores->push(['id' => intval($empleado->supervisor->id), 'peso' => $this->pesoEvaluacionJefe, 'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO]);
        //     }
        // }
        // $lista_evaluado_por_equipo_a_cargo = collect();
        // if ($evaluacion->evaluado_por_equipo_a_cargo) {
        //     if ($empleado->children) {
        //         $childrens = $empleado->children;
        //         $equipo = $this->obtenerEquipoACargo($childrens);
        //         foreach ($equipo as $e) {
        //             $lista_evaluado_por_equipo_a_cargo->push(['id' => $e, 'peso' => $this->pesoEvaluacionEquipo, 'tipo' => EvaluadoEvaluador::EQUIPO]);
        //         }
        //         if (count($lista_evaluado_por_equipo_a_cargo)) {
        //             $evaluadores->push($lista_evaluado_por_equipo_a_cargo->random());
        //         }
        //     }
        // }

        // $lista_empleados_misma_area = collect();
        // if ($evaluacion->evaluado_por_misma_area) {
        //     if ($empleado->empleados_misma_area) {
        //         foreach ($empleado->empleados_misma_area as $evaluador) {
        //             if ($evaluador != $empleado->id) {
        //                 $lista_empleados_misma_area->push(['id' => intval($evaluador), 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);
        //             }
        //         }
        //         if (count($lista_empleados_misma_area)) {
        //             $evaluadores->push($lista_empleados_misma_area->random());
        //             // while (count($lista_empleados_misma_area)) {
        //             //     if (!$evaluadores->contains('id', $lista_empleados_misma_area->random()['id'])) {

        //             //         break;
        //             //     }
        //             // }
        //         }
        //     }
        // }

        // $evaluadores = $evaluadores->unique('id')->toArray();
        // foreach ($evaluadores as $evaluador) {
        //     EvaluadoEvaluador::create([
        //         'evaluado_id' => $empleado->id,
        //         'evaluador_id' => $evaluador['id'],
        //         'evaluacion_id' => $evaluacion->id,
        //         'peso' => intval($evaluador['peso']),
        //         'tipo' => $evaluador['tipo'],
        //     ]);
        // }
        // dd($listaEvaluado);
        foreach ($listaEvaluado['evaluadores'] as $evaluador) {
            // Skip if the evaluator ID is not valid
            if (empty($evaluador['id'])) {
                continue;
            }

            EvaluadoEvaluador::create([
                'evaluado_id' => $listaEvaluado['evaluado']['id'],
                'evaluador_id' => $evaluador['id'],
                'evaluacion_id' => $evaluacion->id,
                'peso' => intval($evaluador['peso']),
                'tipo' => $evaluador['tipo'],
            ]);
        }
    }

    public function relatedCompetenciaWithEvaluacion($evaluacion, $competencia)
    {
        EvaluacionCompetencia::create([
            'competencia_id' => intval($competencia),
            'evaluacion_id' => $evaluacion,
        ]);
    }

    public function relatedObjetivoWithEvaluacion($evaluacion, $objetivo)
    {
        EvaluacionObjetivo::create([
            'objetivo_id' => intval($objetivo),
            'evaluacion_id' => $evaluacion,
        ]);
    }

    public function obtenerEquipoACargo($childrens)
    {
        $equipo_a_cargo = collect();

        foreach ($childrens as $evaluador) {
            $equipo_a_cargo->push($evaluador->id);

            if (count($evaluador->children)) {
                $equipo_a_cargo = $equipo_a_cargo->merge($this->obtenerEquipoACargo($evaluador->children));
            }
        }

        return $equipo_a_cargo->toArray();
    }

    public function crearCuestionario($evaluacion, $evaluado, $evaluadores, $includeCompetencias, $includeObjetivos)
    {
        //se modifico el codigo para no generar consultas de mas y hacer cargas batch
        $empleado = Empleado::select(
            'id',
            'name',
            'area_id',
            'supervisor_id',
            'puesto_id',
            'estatus',
        )->with(['objetivos.objetivo', 'children', 'supervisor', 'area', 'puestoRelacionado'])->where('estatus', 'alta')->where('id',intval($evaluado))->first();
        $evaluadores_objetivos = collect();
        $evaluacion = Evaluacion::with('competencias')->find($evaluacion->id);


        if ($includeObjetivos) {
            // Add empleado and supervisor as evaluadores_objetivos
            $supervisorObjetivos = $evaluadores->firstWhere('tipo', EvaluadoEvaluador::JEFE_INMEDIATO);
            $evaluadores_objetivos = collect([
                ['id' => intval($empleado->id), 'peso' => 0],
                ['id' => intval($supervisorObjetivos->evaluador_id), 'peso' => 100],
            ]);
        }

        if ($includeCompetencias) {
            $competencias = $empleado->puestoRelacionado->competencias ?? null;
            if (! is_null($competencias)) {
                $evaluacionRespuestas = [];
                foreach ($evaluadores as $evaluador) {
                    foreach ($competencias as $competencia) {
                        $evaluacionRespuestas[] = [
                            'calificacion' => null,
                            'descripcion' => null,
                            'competencia_id' => $competencia->competencia_id,
                            'evaluado_id' => $empleado->id,
                            'evaluador_id' => $evaluador->evaluador_id,
                            'evaluacion_id' => $evaluacion->id,
                        ];
                    }
                }
                // Batch insert evaluacion respuestas
                EvaluacionRepuesta::insert($evaluacionRespuestas);
            }
        }

        if ($includeObjetivos) {
            $objetivos = [];
            foreach ($empleado->objetivos as $obj) {
                // dump($obj->objetivo->esta_aprobado);
                if (intval($obj->objetivo->esta_aprobado) == Objetivo::APROBADO) {
                    // dd('entra');
                    $objetivos[] = $obj->objetivo_id;
                }
                // dd($objetivos, gettype(intval($obj->objetivo->esta_aprobado)), gettype(Objetivo::APROBADO));
            }
            // dd('Aprobado');
            // dump($objetivos);
            if (! empty($objetivos)) {
                $objetivoIds = $objetivos;
                $evaluadores_objetivos = $evaluadores_objetivos->unique('id')->toArray();
                // dd($empleado->objetivos, $objetivos, $objetivoIds, $evaluadores_objetivos);
                // $objetivoIds = $objetivos->pluck('objetivo_id')->toArray();
                // $evaluadores_objetivos = $evaluadores_objetivos->unique('id')->toArray();
                $objetivoRespuestas = [];
                foreach ($evaluadores_objetivos as $evaluador) {
                    foreach ($objetivoIds as $objetivoId) {
                        $objetivoRespuestas[] = [
                            'meta_alcanzada' => 'Sin evaluar',
                            'calificacion_persepcion' => null,
                            'calificacion' => null,
                            'objetivo_id' => $objetivoId,
                            'evaluado_id' => $empleado->id,
                            'evaluador_id' => $evaluador['id'],
                            'evaluacion_id' => $evaluacion->id,
                        ];
                    }
                }
                // dd($objetivoRespuestas);

                // Batch insert objetivo respuestas
                ObjetivoRespuesta::insert($objetivoRespuestas);
                // dd($BATCH);
            }
        }
    }

    public function enviarCorreoAEvaluadores($evaluacion)
    {
        // Fetch unique evaluators IDs for the given evaluation
        $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->distinct('evaluador_id')->pluck('evaluador_id');

        foreach ($evaluadores as $evaluadorId) {
            // Fetch unique evaluated employees IDs for each evaluator
            $evaluados = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                ->where('evaluador_id', $evaluadorId)->distinct('evaluado_id')->pluck('evaluado_id');

            // Fetch evaluator and evaluated employees models
            $evaluador = Empleado::find($evaluadorId);
            $evaluados = Empleado::whereIn('id', $evaluados)->get();

            // Send notification to the evaluator
            $this->enviarNotificacionAlEvaluador($evaluador->email, $evaluacion, $evaluador, $evaluados);

            // Add delay for local development environment (optional)
            if (app()->environment('local') && config('mail.host') == 'smtp.mailtrap.io') {
                usleep(500000); // Delay execution for half a second
            }
        }
    }

    public function enviarNotificacionAlEvaluador($email, $evaluacion, $evaluador, $evaluados)
    {
        Mail::to(removeUnicodeCharacters($email))->queue(new NotificacionEvaluador($evaluacion, $evaluador, $evaluados));
    }

    public function obtenerEvaluadosConEvaluadores($evaluados_objetivo)
    {
        $evaluados = [];

        switch ($evaluados_objetivo) {
            case 'all':
                // $evaluados = Empleado::getAltaEmpleadosEvaluaciones()->pluck('id')->toArray();
                $evaluados = DB::table('empleados')
                    ->select(
                        'empleados.id',
                        'empleados.name',
                        'empleados.email',
                        'empleados.area_id',
                        'empleados.puesto_id',
                        'areas.id as area_id',
                        'areas.area',
                        'puestos.id as puesto_id',
                        'puestos.puesto'
                    )
                    ->join('areas', 'empleados.area_id', '=', 'areas.id')
                    ->join('puestos', 'empleados.puesto_id', '=', 'puestos.id')
                    ->where('empleados.estatus', 'alta')
                    ->whereNull('empleados.deleted_at')
                    ->pluck('empleados.id')
                    ->toArray();
                break;
            case 'area':
                $evaluados_area = intval($this->by_area);
                $evaluados = DB::table('empleados')
                    ->select('empleados.id', 'empleados.name', 'empleados.email', 'empleados.area_id', 'empleados.puesto_id')
                    ->join('areas', 'empleados.area_id', '=', 'areas.id')
                    ->join('puestos', 'empleados.puesto_id', '=', 'puestos.id')
                    ->select(
                        'empleados.id',
                        'empleados.name',
                        'empleados.email',
                        'empleados.area_id',
                        'empleados.puesto_id',
                        'areas.id as area_id',
                        'areas.area',
                        'puestos.id as puesto_id',
                        'puestos.puesto'
                    )
                    ->where('empleados.estatus', 'alta')
                    ->whereNull('empleados.deleted_at')
                    ->where('empleados.area_id', $evaluados_area)
                    ->pluck('empleados.id')
                    ->toArray();
                // $evaluados = Empleado::getAltaEmpleadosEvaluaciones();
                // dd($evaluados);
                break;
            case 'manual':
                $evaluados = $this->by_manual;
                break;
            default:
                $evaluados = GruposEvaluado::find(intval($evaluados_objetivo))->empleados->pluck('id')->toArray();
                break;
        }
        // Inicia el contador de tiempo
        // dd($evaluados);
        $start = microtime(true);
        // Aquí colocas tu consulta

        // Calcula el tiempo transcurrido

        $evaluadosEvaluadores = collect();
        // $emps = Empleado::getaltaAllEvaluacionesObjetivoSupervisorChildren();
        $emps = Empleado::select(
            'id',
            'name',
            'area_id',
            'supervisor_id',
            'puesto_id'
        )
        ->with(['objetivos', 'children:id,name', 'supervisor:id,name', 'area:id,area', 'puestoRelacionado:id,puesto'])
        ->where('estatus', 'alta')
        ->whereNull('deleted_at')
        ->get();

        $validIds = $emps->pluck('id')->toArray();

        foreach ($evaluados as $evaluado) {
            $empleado = $emps->firstWhere('id', intval($evaluado));

            if (!$empleado) {
                // Intenta buscar directamente en la base de datos
                $empleado = Empleado::with([
                    'objetivos', 'children:id,name', 'supervisor:id,name',
                    'area:id,area', 'puestoRelacionado:id,puesto'
                ])->where('estatus', 'alta')->find(intval($evaluado));

                if (!$empleado) {
                    // Si no se encuentra en la base de datos, maneja el caso
                    dd("Empleado no encontrado para evaluado: {$evaluado}");
                }

                // Agrega el empleado encontrado a la colección para evitar búsquedas repetidas
                $emps->push($empleado);
            }

            $evaluadores = collect();

            try {
                $evaluadores->put('autoevaluacion', [
                    'id' => intval($empleado->id),
                    'peso' => $this->pesoAutoevaluacion,
                    'tipo' => EvaluadoEvaluador::AUTOEVALUACION,
                ]);

                $evaluadores->put('jefe', [
                    'id' => $empleado->supervisor ? intval($empleado->supervisor->id) : Empleado::getAltaEmpleados()->unique()->random()->id,
                    'peso' => $this->pesoEvaluacionJefe,
                    'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO,
                ]);

                $equipo = $empleado->children->isEmpty() ? [Empleado::getAltaEmpleados()->unique()->random()->id] : $this->obtenerEquipoACargo($empleado->children);
                $evaluadores->put('subordinado', [
                    'id' => $equipo[array_rand($equipo)],
                    'peso' => $this->pesoEvaluacionEquipo,
                    'tipo' => EvaluadoEvaluador::EQUIPO,
                ]);

                $evaluadores->put('par', [
                    'id' => Empleado::getAltaEmpleados()->unique()->random()->id,
                    'peso' => $this->pesoEvaluacionArea,
                    'tipo' => EvaluadoEvaluador::MISMA_AREA,
                ]);

                $evaluadosEvaluadores->push([
                    'evaluado' => $empleado,
                    'evaluadores' => $evaluadores,
                ]);
            } catch (\Throwable $th) {
                // Captura errores y muestra información relevante
                dd($th, $empleado, $evaluado);
            }
        }


        $this->time_elapsed_secs
            =
            microtime(true) -
            $start;
        // Imprime el tiempo de ejecución

        return $evaluadosEvaluadores;
    }

    public function repetirConsultaCompetencias()
    {
        foreach ($this->listaIDSinCompetencias as $IDsinComp) {

            $rev_emp_comp = Empleado::select(
                'id',
                'name',
                'area_id',
                'puesto_id',
            )->with(['area:id,area', 'puestoRelacionado:id,puesto'])
                ->where('estatus', 'alta')
                ->whereNull('deleted_at')
                ->where('empleados.id', $IDsinComp)
                ->first();
            if ($rev_emp_comp->competencias_asignadas > 0) {
                $this->listaEmpleadosSinCompetencias = $this->listaEmpleadosSinCompetencias->filter(function ($item) use ($rev_emp_comp) {
                    return $item !== $rev_emp_comp->name;
                });
            }
        }

        $this->totalEmpleadosSinCompetencias = $this->listaEmpleadosSinCompetencias->count();

        if ($this->totalEmpleadosSinCompetencias == 0) {
            $this->hayEmpleadosSinCompetencias = false;
        }

        if (
            $this->hayEmpleadosSinCompetencias == false &&
            $this->hayEmpleadosSinObjetivos == false &&
            $this->hayEmpleadosObjetivosPendiente == false
        ) {
            $this->bloquear_evaluacion = false;
        }
    }

    public function repetirConsultaObjetivos()
    {
        foreach ($this->listaIDSinObjetivos as $IDsinObj) {

            $rev_emp_obj = Empleado::select(
                'id',
                'name',
                'area_id',
                'puesto_id',
            )->with(['area:id,area', 'objetivos:id,objetivo_id,empleado_id'])
                ->where('estatus', 'alta')
                ->whereNull('deleted_at')
                ->where('empleados.id', $IDsinObj)
                ->first();
            if ($rev_emp_obj->objetivos_asignados['cuenta'] > 0) {
                $this->listaEmpleadosSinObjetivos = $this->listaEmpleadosSinObjetivos->filter(function ($item) use ($rev_emp_obj) {
                    return $item !== $rev_emp_obj->name;
                });
            }
        }
        $this->totalEmpleadosSinObjetivos = $this->listaEmpleadosSinObjetivos->count();

        if ($this->totalEmpleadosSinObjetivos == 0) {
            $this->hayEmpleadosSinObjetivos = false;
        }

        if (
            $this->hayEmpleadosSinCompetencias == false &&
            $this->hayEmpleadosSinObjetivos == false &&
            $this->hayEmpleadosObjetivosPendiente == false
        ) {
            $this->bloquear_evaluacion = false;
        }
    }

    public function repetirConsultaObjetivosPendientes()
    {
        foreach ($this->listaIDObjetivosPendiente as $IDObjPen) {

            $rev_emp_obj_pend = Empleado::select(
                'id',
                'name',
                'area_id',
                'puesto_id',
            )->with(['area:id,area', 'objetivos:id,objetivo_id,empleado_id'])
                ->where('estatus', 'alta')
                ->whereNull('deleted_at')
                ->where('empleados.id', $IDObjPen)
                ->first();

            if ($rev_emp_obj_pend->objetivos_asignados['pendientes'] == false) {
                $this->listaEmpleadosObjetivosPendiente = $this->listaEmpleadosObjetivosPendiente->filter(function ($item) use ($rev_emp_obj_pend) {
                    return $item !== $rev_emp_obj_pend->name;
                });
            }
        }
        $this->totalEmpleadosObjetivosPendiente = $this->listaEmpleadosObjetivosPendiente->count();

        if ($this->totalEmpleadosObjetivosPendiente == 0) {
            $this->hayEmpleadosObjetivosPendiente = false;
        }

        if (
            $this->hayEmpleadosSinCompetencias == false &&
            $this->hayEmpleadosSinObjetivos == false &&
            $this->hayEmpleadosObjetivosPendiente == false
        ) {
            $this->bloquear_evaluacion = false;
        }
    }
}
