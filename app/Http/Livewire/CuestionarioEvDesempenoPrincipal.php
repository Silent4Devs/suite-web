<?php

namespace App\Http\Livewire;

use App\Models\EvaluacionDesempeno;
use App\Models\User;
use Livewire\Component;

class CuestionarioEvDesempenoPrincipal extends Component
{
    public $evaluacionDesempeno;
    public $evaluado;
    public $periodo;
    public $acceso_objetivos;
    public $acceso_competencias;

    public $autoevaluacion = false;

    public $objetivos_evaluado;
    public $objetivos_autoevaluado;

    public $competencias_evaluado;
    public $competencias_autoevaluado;

    public $dataFromChild1;
    public $dataFromChild2;

    protected $listeners = ['dataFromChild1', 'dataFromChild2'];

    public function mount($evD, $evld, $per, $ao, $ac)
    {
        $this->evaluacionDesempeno = $evD;
        $this->evaluado = $evld;
        $this->periodo = $per;
        $this->acceso_objetivos = $ao;
        $this->acceso_competencias = $ac;

        $evaluador = User::getCurrentUser()->empleado;

        $evaluacion = EvaluacionDesempeno::find($evD->id);
        $evaluado = $evaluacion->evaluados->find($this->evaluado->id);

        if ($evaluacion->activar_objetivos == true) {
            $this->buscarObjetivos($evaluador, $evaluacion, $evaluado);
        }

        if ($evaluacion->activar_competencias == true) {
            $this->buscarCompetencias($evaluador, $evaluacion, $evaluado);
        }

        if ($evaluado->empleado->id == $evaluador->id) {
            $this->autoevaluacion = true;
        }

        if ($evaluado->empleado->id == $evaluador->id) {
            $this->autoevaluacion = true;
        }

        $this->progresoEvaluacion();
    }

    public function render()
    {
        return view('livewire.cuestionario-ev-desempeno-principal');
    }

    // Method to receive data from Child1
    public function dataFromChild1($data)
    {
        $this->dataFromChild1 = $data;
    }

    public function dataFromChild2($data)
    {
        $this->dataFromChild2 = $data;
    }

    public function buscarCompetencias($evaluador, $evaluacion, $evaluado)
    {
        $busqueda_evaluador = $evaluado->evaluadoresCompetencias($this->periodo)->where('evaluador_desempeno_id', $evaluador->id)->first();
        $busqueda_autoevaluador = $evaluado->evaluadoresCompetencias($this->periodo)->where('evaluador_desempeno_id', $evaluado->evaluado_desempeno_id)->first();

        if ($busqueda_evaluador || $busqueda_autoevaluador) {

            if ($busqueda_evaluador) {
                $this->competencias_evaluado = $busqueda_evaluador->preguntasCuestionario->where('periodo_id', $this->periodo)->sortBy('id');
            }

            if ($busqueda_autoevaluador) {
                $this->competencias_autoevaluado = $busqueda_autoevaluador->preguntasCuestionario->where('periodo_id', $this->periodo)->sortBy('id');
            }
        }
    }

    public function buscarObjetivos($evaluador, $evaluacion, $evaluado)
    {
        $busqueda_evaluador = $evaluado->evaluadoresObjetivos($this->periodo)->where('evaluador_desempeno_id', $evaluador->id)->first();
        $busqueda_autoevaluador = $evaluado->evaluadoresObjetivos($this->periodo)->where('evaluador_desempeno_id', $evaluado->evaluado_desempeno_id)->first();

        if ($busqueda_evaluador || $busqueda_autoevaluador) {
            if ($busqueda_evaluador) {
                $this->objetivos_evaluado = $busqueda_evaluador->preguntasCuestionario->where('periodo_id', $this->periodo)->sortBy('id');
            }

            if ($busqueda_autoevaluador) {
                $this->objetivos_autoevaluado = $busqueda_autoevaluador->preguntasCuestionario->where('periodo_id', $this->periodo)->sortBy('id');
            }
        }
    }

    public function progresoEvaluacion()
    {
        if ($this->evaluacionDesempeno->activar_objetivos == true) {
            $nPreguntasC = $this->competencias_evaluado->count();
            $contestadasC = $this->competencias_evaluado->where('estatus_calificado', true)->count();
            $this->dataFromChild2 = round((($contestadasC / $nPreguntasC) * 100), 2);
        }

        if ($this->evaluacionDesempeno->activar_competencias == true) {
            $nPreguntasO = $this->objetivos_evaluado->count();
            $contestadasO = $this->objetivos_evaluado->where('estatus_calificado', true)->count();
            $this->dataFromChild1 = round((($contestadasO / $nPreguntasO) * 100), 2);
        }
    }
}
