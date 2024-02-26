<?php

namespace App\Http\Livewire;

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
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class MultiStepForm extends Component
{
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

    public $pesoGeneralCompetencias = 50;

    public $showPesoGeneralObjetivos = false;

    public $pesoGeneralObjetivos = 50;

    public $sumaTotalPesoGeneral;

    public $catalogoObjetivos = '';

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

    public $totalSteps = 5;

    public $currentStep = 1;

    public $hoy;

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
        $this->emit('select2');
    }

    public function render()
    {
        $evaluacion = new Evaluacion;
        $areas = Area::getAll();
        $empleados = Empleado::getIDaltaAll();
        $grupos_evaluados = GruposEvaluado::getAll();
        $catalogo_rangos_objetivos = CatalogoRangosObjetivos::get();

        $competencias = Competencia::search($this->search)->simplePaginate($this->perPage);
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
        $this->resetErrorBag();
        $this->validateData();
        $this->emit('increaseStep');
        $this->currentStep++;
        if ($this->currentStep == 3) {
            $this->listaEvaluados = $this->obtenerEvaluadosConEvaluadores($this->evaluados_objetivo);
            // dd($this->evaluados_objetivo);
        }
        if ($this->currentStep == 4) {
            $this->listaEmpleadosSinCompetencias = collect();
            $this->totalEmpleadosSinCompetencias = 0;
            $this->hayEmpleadosSinCompetencias = false;
            foreach ($this->listaEvaluados as $evaluadoL) {
                if ($evaluadoL['evaluado']['competencias_asignadas'] == 0) {
                    $this->hayEmpleadosSinCompetencias = true;
                    $this->totalEmpleadosSinCompetencias++;
                    $this->listaEmpleadosSinCompetencias->push($evaluadoL['evaluado']['name']);
                }
            }
        }

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->emit('decreaseStep');
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
                $evaluados = Empleado::getIDaltaAll()->pluck('id')->toArray();
                break;
            case 'area':
                $evaluados = Empleado::getIDaltaAll()->where('area_id', $this->by_area)->pluck('id')->toArray();
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

        $evaluados_puesto = Empleado::with('puestoRelacionado')->whereIn('id', $evaluados)->get()->pluck('puestoRelacionado.id', 'id')->toArray();

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
        $empleado = Empleado::getaltaAllObjetivoSupervisorChildren()->find(intval($evaluado));
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
                            'calificacion' => 0,
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
            $objetivos = $empleado->objetivos()->where('esta_aprobado', Objetivo::APROBADO)->get(['objetivo_id']);
            if ($objetivos->isNotEmpty()) {
                $objetivoIds = $objetivos->pluck('objetivo_id')->toArray();
                $evaluadores_objetivos = $evaluadores_objetivos->unique('id')->toArray();
                $objetivoRespuestas = [];
                foreach ($evaluadores_objetivos as $evaluador) {
                    foreach ($objetivoIds as $objetivoId) {
                        $objetivoRespuestas[] = [
                            'meta_alcanzada' => 'Sin evaluar',
                            'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                            'calificacion' => 0,
                            'objetivo_id' => $objetivoId,
                            'evaluado_id' => $empleado->id,
                            'evaluador_id' => $evaluador['id'],
                            'evaluacion_id' => $evaluacion->id,
                        ];
                    }
                }

                // Batch insert objetivo respuestas
                ObjetivoRespuesta::insert($objetivoRespuestas);
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
                $evaluados = Empleado::getIDaltaAll()->pluck('id')->toArray();
                break;
            case 'area':
                $evaluados_area = intval($this->by_area);
                $evaluados = Empleado::getIDaltaAll()->where('area_id', $evaluados_area)->pluck('id')->toArray();
                break;
            case 'manual':
                $evaluados = $this->by_manual;
                break;
            default:
                $evaluados = GruposEvaluado::find(intval($evaluados_objetivo))->empleados->pluck('id')->toArray();
                break;
        }

        $evaluadosEvaluadores = collect();
        $emps = Empleado::getaltaAllObjetivoSupervisorChildren();

        foreach ($evaluados as $evaluado) {
            $empleado = $emps->find(intval($evaluado));
            $evaluadores = collect();

            $evaluadores->put('autoevaluacion', ['id' => intval($empleado->id), 'peso' => $this->pesoAutoevaluacion, 'tipo' => EvaluadoEvaluador::AUTOEVALUACION]);

            $evaluadores->put('jefe', [
                'id' => $empleado->supervisor ? intval($empleado->supervisor->id) : Empleado::getIDaltaAll()->unique()->random()->id,
                'peso' => $this->pesoEvaluacionJefe,
                'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO,
            ]);

            $equipo = $empleado->children->isEmpty() ? [Empleado::getIDaltaAll()->unique()->random()->id] : $this->obtenerEquipoACargo($empleado->children);
            $evaluadores->put('subordinado', ['id' => $equipo[array_rand($equipo)], 'peso' => $this->pesoEvaluacionEquipo, 'tipo' => EvaluadoEvaluador::EQUIPO]);

            $evaluadores->put('par', ['id' => Empleado::getIDaltaAll()->unique()->random()->id, 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);

            $evaluadosEvaluadores->push(['evaluado' => $empleado, 'evaluadores' => $evaluadores]);
        }

        return $evaluadosEvaluadores;
    }
}
