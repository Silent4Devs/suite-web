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

    public $showTable = false;

    public $search = '';

    public $perPage = 10;

    public $filter = 1;

    public $selected = [];

    public $sendEmail = true;

    //STEP 1
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
    // public $description;

    //STEP 2
    protected $listeners = ['grupoEvaluadosSaved' => 'render'];

    public $evaluados_objetivo;

    public $by_manual;

    public $by_area;

    public $habilitarSelectManual = false;

    public $habilitarSelectAreas = false;

    public $listaEvaluados;

    //STEP 3
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

    //STEP 4
    public $periodos = [];

    public $hayEmpleadosSinCompetencias = false;

    public $totalEmpleadosSinCompetencias = 0;

    public $listaEmpleadosSinCompetencias;

    public $totalSteps = 5;

    public $currentStep = 1;

    public function mount()
    {
        $this->currentStep = 1;
        $this->periodos = [[
            'fecha_inicio' => Carbon::now()->format('Y-m-d'),
            'fecha_fin' => Carbon::now()->addMonth()->format('Y-m-d'),
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
        switch ($tipo) {
            case 'jefe_inmediato':
                if ($this->evaluado_por_jefe) {
                    $this->typeEvaluation = $this->typeEvaluation + 90;
                } else {
                    $this->typeEvaluation = $this->typeEvaluation - 90;
                }
                break;
            case 'equipo_a_cargo':
                if ($this->evaluado_por_equipo_a_cargo) {
                    $this->typeEvaluation = $this->typeEvaluation + 90;
                } else {
                    $this->typeEvaluation = $this->typeEvaluation - 90;
                }
                break;
            case 'misma_area':
                if ($this->evaluado_por_misma_area) {
                    $this->typeEvaluation = $this->typeEvaluation + 90;
                } else {
                    $this->typeEvaluation = $this->typeEvaluation - 90;
                }
                break;
            case 'autoevaluacion':
                if ($this->autoevaluacion) {
                    $this->typeEvaluation = $this->typeEvaluation + 90;
                } else {
                    $this->typeEvaluation = $this->typeEvaluation - 90;
                }
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
            'fecha_inicio' => Carbon::now()->format('Y-m-d'),
            'fecha_fin' => Carbon::now()->addMonth()->format('Y-m-d'),
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
        if ($this->includeCompetencias == null && $this->includeObjetivos == null) {
            $this->validate([
                'nombre' => 'required|string|max:250',
                'descripcion' => 'nullable|string|max:1000',
                'includeCompetencias' => 'accepted',
                'includeObjetivos' => 'accepted',
            ], [
                'includeCompetencias.accepted' => 'Debes de incluir al menos una opción',
                'includeObjetivos.accepted' => 'Debes de incluir al menos una opción',
            ]);
        } else {
            if ($this->includeCompetencias && $this->includeObjetivos) {
                $this->sumaTotalPesoGeneral = $this->pesoGeneralCompetencias + $this->pesoGeneralObjetivos;
                $this->validate([
                    'nombre' => 'required|string|max:250',
                    'descripcion' => 'nullable|string|max:1000',
                    'pesoGeneralCompetencias' => 'required|numeric',
                    'pesoGeneralObjetivos' => 'required|numeric',
                    'catalogoObjetivos' => 'required|numeric',
                    'sumaTotalPesoGeneral' => 'required|numeric|min:100|max:100',
                ], [
                    'sumaTotalPesoGeneral.max' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPesoGeneral.'%',
                    'sumaTotalPesoGeneral.min' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPesoGeneral.'%',
                ]);
            } elseif ($this->includeCompetencias && $this->includeObjetivos == null) {
                $this->sumaTotalPesoGeneral = $this->pesoGeneralCompetencias;
                $this->pesoGeneralObjetivos = 0;
                $this->validate([
                    'nombre' => 'required|string|max:250',
                    'descripcion' => 'nullable|string|max:1000',
                    'pesoGeneralCompetencias' => 'required|numeric|min:100|max:100',
                    'sumaTotalPesoGeneral' => 'required|numeric|min:100|max:100',
                ], [
                    'sumaTotalPesoGeneral.max' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPesoGeneral.'%',
                    'sumaTotalPesoGeneral.min' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPesoGeneral.'%',
                ]);
            } elseif ($this->includeCompetencias == null && $this->includeObjetivos) {
                $this->sumaTotalPesoGeneral = $this->pesoGeneralObjetivos;
                $this->pesoGeneralCompetencias = 0;
                $this->validate([
                    'nombre' => 'required|string|max:250',
                    'descripcion' => 'nullable|string|max:1000',
                    'pesoGeneralObjetivos' => 'required|numeric|min:100|max:100',
                    'catalogoObjetivos' => 'required|numeric',
                    'sumaTotalPesoGeneral' => 'required|numeric|min:100|max:100',
                ], [
                    'sumaTotalPesoGeneral.max' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPesoGeneral.'%',
                    'sumaTotalPesoGeneral.min' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPesoGeneral.'%',
                ]);
            }
        }
    }

    public function validateStepTwo()
    {
        if ($this->evaluados_objetivo == 'manual') {
            $this->validate([
                'evaluados_objetivo' => 'required',
                'by_manual' => 'required',
            ], [
                'evaluados_objetivo.required' => 'El campo público objetivo es requerido',
                'by_manual.required' => 'El campo de selección manual por empleados es requerido',
            ]);
        } elseif ($this->evaluados_objetivo == 'area') {
            $this->validate([
                'evaluados_objetivo' => 'required',
                'by_area' => 'required',
            ], [
                'evaluados_objetivo.required' => 'El campo público objetivo es requerido',
                'by_area.required' => 'El campo de selección por área es requerido',
            ]);
        } else {
            $this->validate([
                'evaluados_objetivo' => 'required',
            ], [
                'evaluados_objetivo.required' => 'El campo público objetivo es requerido',
            ]);
        }
    }

    public function validateStepThree()
    {
        // foreach($this->listaEvaluados as $listaEvaluado){
        //     foreach($listaEvaluado['evaluadores'] as $evaluador){
        //         if($evaluador['id'] == 0){
        //             $this->aceptado = false;
        //             break;
        //         }
        //     }
        // }
        // dd($this->listaEvaluados[83]);
        // $this->validate([
        //     'listaEvaluados.*.evaluadores.*.id' => 'required|numeric|gt:0'
        // ]);
        $this->sumaTotalPeso = 0;
        if ($this->evaluado_por_jefe == false && $this->evaluado_por_misma_area == false && $this->evaluado_por_equipo_a_cargo == false && $this->autoevaluacion == false) {
            $this->validate([
                'evaluado_por_jefe' => 'accepted',
                'evaluado_por_misma_area' => 'accepted',
                'evaluado_por_equipo_a_cargo' => 'accepted',
                'autoevaluacion' => 'accepted',
            ], [
                'evaluado_por_jefe.accepted' => 'Debes de incluir al menos una opción',
                'evaluado_por_misma_area.accepted' => 'Debes de incluir al menos una opción',
                'evaluado_por_equipo_a_cargo.accepted' => 'Debes de incluir al menos una opción',
                'autoevaluacion.accepted' => 'Debes de incluir al menos una opción',
            ]);
        }
        if ($this->evaluado_por_jefe) {
            $this->sumaTotalPeso += $this->pesoEvaluacionJefe;
            $this->validate([
                'pesoEvaluacionJefe' => 'required|numeric|max:100|min:0',
            ], [
                'pesoEvaluacionJefe.required' => 'El peso es requerido',
                'pesoEvaluacionJefe.max' => 'El peso máximo es 100%',
                'pesoEvaluacionJefe.min' => 'El peso mínimo es 0%',
            ]);
        }
        if ($this->evaluado_por_misma_area) {
            $this->sumaTotalPeso += $this->pesoEvaluacionArea;
            $this->validate([
                'pesoEvaluacionArea' => 'required|numeric|max:100|min:0',
            ], [
                'pesoEvaluacionArea.required' => 'El peso es requerido',
                'pesoEvaluacionArea.max' => 'El peso máximo es 100%',
                'pesoEvaluacionArea.min' => 'El peso mínimo es 0%',
            ]);
        }
        if ($this->evaluado_por_equipo_a_cargo) {
            $this->sumaTotalPeso += $this->pesoEvaluacionEquipo;
            $this->validate([
                'pesoEvaluacionEquipo' => 'required|numeric|max:100|min:0',
            ], [
                'pesoEvaluacionEquipo.required' => 'El peso es requerido',
                'pesoEvaluacionEquipo.max' => 'El peso máximo es 100%',
                'pesoEvaluacionEquipo.min' => 'El peso mínimo es 0%',
            ]);
        }
        if ($this->autoevaluacion) {
            $this->sumaTotalPeso += $this->pesoAutoevaluacion;
            $this->validate([
                'pesoAutoevaluacion' => 'required|numeric|max:100|min:0',
            ], [
                'pesoAutoevaluacion.required' => 'El peso es requerido',
                'pesoAutoevaluacion.max' => 'El peso máximo es 100%',
                'pesoAutoevaluacion.min' => 'El peso mínimo es 0%',
            ]);
        }

        $this->validate([
            'sumaTotalPeso' => 'numeric|max:100|min:100',
        ], [
            'sumaTotalPeso.max' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPeso.'%',
            'sumaTotalPeso.min' => 'El peso total debe de ser 100% el total actual es: '.$this->sumaTotalPeso.'%',
        ]);
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
        if ($evaluados_objetivo == 'all') {
            $evaluados = Empleado::getIDaltaAll()->pluck('id')->toArray();
        } elseif ($evaluados_objetivo == 'area') {
            $evaluados_area = intval($this->by_area);
            $evaluados = Empleado::getIDaltaAll()->where('area_id', $evaluados_area)->pluck('id')->toArray();
        } elseif ($evaluados_objetivo == 'manual') {
            $evaluados = $this->by_manual;
        } else {
            $evaluados = GruposEvaluado::find(intval($evaluados_objetivo))->empleados->pluck('id')->toArray();
        }
        $evaluacion = Evaluacion::create([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'estatus' => $estatus,
            'evaluados_objetivo' => $evaluados_objetivo,
            'autor_id' => User::getCurrentUser()->empleado->id,
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
            'include_competencias' => $this->includeCompetencias ? $this->includeCompetencias : false,
            'include_objetivos' => $this->includeObjetivos ? $this->includeObjetivos : false,
        ]);
        $evaluados_puesto = [];
        foreach ($evaluados as $evaluado) {
            $evaluados_puesto[] = [
                'evaluado_id' => $evaluado,
                'puesto_id' => Empleado::with('puestoRelacionado')->find($evaluado)->puestoRelacionado->id,
            ];
        }
        $evaluacion->evaluados()->sync($evaluados_puesto);

        // foreach ($evaluados as $evaluado) {
        //     $this->relacionarEvaluadoConEvaluadores($evaluacion, $evaluado);
        // }
        foreach ($this->listaEvaluados as $listaEvaluado) {
            $this->relacionarEvaluadoConEvaluadores($evaluacion, $listaEvaluado);
        }
        // if ($this->includeCompetencias) {
        //     $competenciasSeleccionadas = $this->selected;
        //     foreach ($competenciasSeleccionadas as $competencia) {
        //         $this->relatedCompetenciaWithEvaluacion($evaluacion->id, $competencia);
        //     }
        // }
        if ($estatus == Evaluacion::ACTIVE) {
            $evaluados = $evaluacion->evaluados;
            foreach ($evaluados as $evaluado) {
                $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)->get();
                $this->crearCuestionario($evaluacion, $evaluado->id, $evaluadores, $this->includeCompetencias, $this->includeObjetivos);
            }
        }

        //Se asignan los valores que tendra la evaluacion
        $catalogo = CatalogoRangosObjetivos::with('rangos')->find($this->catalogoObjetivos);

        foreach ($catalogo->rangos as $r) {
            Ev360ParametrosObjetivos::create([
                'evaluacion_id' => $evaluacion->id,
                'parametro' => $r->parametro,
                'valor' => $r->valor,
                'color' => $r->color,
                'descripcion' => $r->descripcion,
            ]);
        }

        if ($idx == 0) {
            if ($this->sendEmail) {
                $evaluacion->update([
                    'email_sended' => true,
                ]);
                $this->enviarCorreoAEvaluadores($evaluacion, $evaluadores);
            }
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
            if ($evaluador['id'] != 0 && $evaluador['id'] != '' && $evaluador['id'] != null) {
                EvaluadoEvaluador::create([
                    'evaluado_id' => $listaEvaluado['evaluado']['id'],
                    'evaluador_id' => $evaluador['id'],
                    'evaluacion_id' => $evaluacion->id,
                    'peso' => intval($evaluador['peso']),
                    'tipo' => $evaluador['tipo'],
                ]);
            }
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
                $equipo_a_cargo->push($this->obtenerEquipoACargo($evaluador->children));
            }
        }

        return $equipo_a_cargo->flatten(1)->toArray();
    }

    public function crearCuestionario($evaluacion, $evaluado, $evaluadores, $includeCompetencias, $includeObjetivos)
    {
        $empleado = Empleado::with('children', 'supervisor', 'objetivos')->find(intval($evaluado));
        $evaluadores_objetivos = collect();
        $evaluacion = Evaluacion::with('competencias')->find($evaluacion->id);

        //Los objetivos siempre se evaluan por autoevalución y jefe inmediato
        if ($includeObjetivos) {
            $supervisorObjetivos = $evaluadores->filter(function ($item) {
                return intval($item->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
            })->first();
            $evaluadores_objetivos->push(['id' => intval($empleado->id), 'peso' => 0]);
            // if ($empleado->supervisorObjetivos) {
            $evaluadores_objetivos->push(['id' => intval($supervisorObjetivos->evaluador_id), 'peso' => 100]);
            // }
        }

        if ($includeCompetencias) {
            foreach ($evaluadores as $evaluador) {
                $competencias_por_puesto = Empleado::with(['puestoRelacionado' => function ($q) {
                    $q->with(['competencias' => function ($q) {
                        $q->with(['competencia']);
                    }]);
                }])->find($empleado->id);
                $competencias = ! is_null($competencias_por_puesto->puestoRelacionado) ? $competencias_por_puesto->puestoRelacionado->competencias : null;
                if (! is_null($competencias)) {
                    foreach ($competencias as $competencia) {
                        EvaluacionRepuesta::create([
                            'calificacion' => 0,
                            'descripcion' => null,
                            'competencia_id' => $competencia->competencia_id,
                            'evaluado_id' => $empleado->id,
                            'evaluador_id' => $evaluador->evaluador_id,
                            'evaluacion_id' => $evaluacion->id,
                        ]);
                    }
                }
            }
        }

        $evaluadores_objetivos = $evaluadores_objetivos->unique('id')->toArray();
        if ($includeObjetivos) {
            $objetivos = $empleado->objetivos;
            if (! is_null($objetivos)) {
                foreach ($evaluadores_objetivos as $evaluador) {
                    foreach ($objetivos as $objetivo) {
                        $objvo = Objetivo::find($objetivo->objetivo_id);
                        if ($objvo->esta_aprobado == Objetivo::APROBADO) {
                            ObjetivoRespuesta::create([
                                'meta_alcanzada' => 'Sin evaluar',
                                'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                                'calificacion' => 0,
                                'objetivo_id' => $objetivo->objetivo_id,
                                'evaluado_id' => $empleado->id,
                                'evaluador_id' => $evaluador['id'],
                                'evaluacion_id' => $evaluacion->id,
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function enviarCorreoAEvaluadores($evaluacion)
    {
        $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->pluck('evaluador_id')->unique()->toArray();
        foreach ($evaluadores as $evaluador) {
            $evaluados = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                ->where('evaluador_id', $evaluador)->pluck('evaluado_id')->unique()->toArray();
            $empleados = Empleado::getAll();
            $evaluados = $empleados->find($evaluados);
            $evaluador_model = $empleados->find($evaluador);
            $this->enviarNotificacionAlEvaluador($evaluador_model->email, $evaluacion, $evaluador_model, $evaluados);
            if (env('APP_ENV') == 'local') { // solo funciona en desarrollo, es una muy mala práctica, es para que funcione con mailtrap y la limitación del plan gratuito
                if (env('MAIL_HOST') == 'smtp.mailtrap.io') {
                    sleep(1); //use usleep(500000) for half a second or less
                }
            }
        }
    }

    public function enviarNotificacionAlEvaluador($email, $evaluacion, $evaluador, $evaluados)
    {
        Mail::to(removeUnicodeCharacters($email))->queue(new NotificacionEvaluador($evaluacion, $evaluador, $evaluados));
    }

    public function obtenerEvaluadosConEvaluadores($evaluados_objetivo)
    {
        if ($evaluados_objetivo == 'all') {
            $evaluados = Empleado::getIDaltaAll()->pluck('id')->toArray();
        } elseif ($evaluados_objetivo == 'area') {
            $evaluados_area = intval($this->by_area);
            $evaluados = Empleado::getIDaltaAll()->where('area_id', $evaluados_area)->pluck('id')->toArray();
        } elseif ($evaluados_objetivo == 'manual') {
            $evaluados = $this->by_manual;
        } else {
            $evaluados = GruposEvaluado::find(intval($evaluados_objetivo))->empleados->pluck('id')->toArray();
        }

        $evaluadosEvaluadores = collect();

        foreach ($evaluados as $evaluado) {
            $empleado = Empleado::with('children', 'supervisor')->find(intval($evaluado));
            $evaluadores = collect();

            $evaluadores->put('autoevaluacion', ['id' => intval($empleado->id), 'peso' => $this->pesoAutoevaluacion, 'tipo' => EvaluadoEvaluador::AUTOEVALUACION]);
            $lista_par_jefe = collect();
            if ($empleado->supervisor) {
                $evaluadores->put('jefe', ['id' => intval($empleado->supervisor->id), 'peso' => $this->pesoEvaluacionJefe, 'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO]);
            } else {
                // foreach ($empleado->empleados_pares as $evaluador) {
                //     if ($evaluador != $empleado->id) {
                //         $lista_par_jefe->push(['id' => intval($evaluador), 'peso' => $this->pesoEvaluacionJefe, 'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO]);
                //     } else {
                //         $evaluadores->put('jefe', ['id' => 135, 'peso' => $this->pesoEvaluacionJefe, 'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO]);
                //     }
                // }
                // if (count($lista_par_jefe)) {
                //     $evaluadores->put('jefe', $lista_par_jefe->random());
                // } else {
                //     $evaluadores->put('jefe', ['id' => 135, 'peso' => $this->pesoEvaluacionJefe, 'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO]);
                // }

                $evaluadores->put('jefe', ['id' => Empleado::getIDaltaAll()->unique()->random()->id, 'peso' => $this->pesoEvaluacionJefe, 'tipo' => EvaluadoEvaluador::JEFE_INMEDIATO]);
            }

            $lista_evaluado_por_equipo_a_cargo = collect();

            if (count($empleado->children) > 0) {
                $childrens = $empleado->children;
                $equipo = $this->obtenerEquipoACargo($childrens);
                foreach ($equipo as $e) {
                    $lista_evaluado_por_equipo_a_cargo->push(['id' => $e, 'peso' => $this->pesoEvaluacionEquipo, 'tipo' => EvaluadoEvaluador::EQUIPO]);
                }
                if (count($lista_evaluado_por_equipo_a_cargo)) {
                    $evaluadores->put('subordinado', $lista_evaluado_por_equipo_a_cargo->random());
                }
            } else {
                $evaluadores->put('subordinado', ['id' => Empleado::getIDaltaAll()->unique()->random()->id, 'peso' => $this->pesoEvaluacionEquipo, 'tipo' => EvaluadoEvaluador::EQUIPO]);
            }

            // $lista_empleados_misma_area = collect();
            // dd(array_rand($empleado->empleados_pares));
            // if (count($empleado->empleados_pares) > 0) {
            //     // foreach ($empleado->empleados_pares as $evaluador) {
            //     //     if ($evaluador != $empleado->id) {
            //     //         $lista_empleados_misma_area->push(['id' => intval($evaluador), 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);
            //     //     } else {
            //     //         $evaluadores->put('par', ['id' => 135, 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);
            //     //     }
            //     // }
            //     // if (count($lista_empleados_misma_area)) {
            //     //     $evaluadores->put('par', $lista_empleados_misma_area->random());
            //     // } else {
            //     //     $evaluadores->put('par', ['id' => 135, 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);
            //     // }
            //     $evaluadores->put('par', ['id' => array_rand($empleado->empleados_pares) > 0 ? array_rand($empleado->empleados_pares) : 135, 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);
            // } else {
            //     $evaluadores->put('par', ['id' => 135, 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);
            // }

            $evaluadores->put('par', ['id' => Empleado::getIDaltaAll()->unique()->random()->id, 'peso' => $this->pesoEvaluacionArea, 'tipo' => EvaluadoEvaluador::MISMA_AREA]);

            // foreach ($evaluadores as $key => $evaluador) {
            //     if ($evaluador['id'] == 0) {
            //         $base = $evaluadores[$key];
            //         $reemplazo = ['id' => 135];
            //         $evaluadores[$key] = array_replace($base, $reemplazo);
            //     }
            // }
            // dd($evaluadores);

            // $evaluadores = $evaluadores->unique('id')->sortBy('tipo')->toArray();

            $evaluadosEvaluadores->push(['evaluado' => $empleado, 'evaluadores' => $evaluadores]);
            // dd($evaluadosEvaluadores);
        }

        return $evaluadosEvaluadores;
    }
}
