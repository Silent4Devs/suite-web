<?php

namespace App\Livewire;

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

    public $dataFromChild1 = null;

    public $dataFromChild2 = null;

    protected $listeners = ['dataFromChild1', 'dataFromChild2'];

    public function mount($evD, $evld, $per, $ao, $ac)
    {
        $this->periodo = $per;
        $this->acceso_objetivos = $ao;
        $this->acceso_competencias = $ac;

        $evaluador = User::getCurrentUser()->empleado;

        $evaluacion = EvaluacionDesempeno::find($evD);
        $this->evaluacionDesempeno = $evaluacion;
        $evaluado = $evaluacion->evaluados->find($evld);
        $this->evaluado = $evaluado;

        if ($evaluacion->activar_objetivos) {
            $this->buscarEvaluacion($evaluador, $evaluado, 'Objetivos');
        }

        if ($evaluacion->activar_competencias) {
            $this->buscarEvaluacion($evaluador, $evaluado, 'Competencias');
        }

        $this->autoevaluacion = ($evaluado->empleado->id == $evaluador->id);
    }

    public function render()
    {
        $this->progresoEvaluacion();

        return view('livewire.cuestionario-ev-desempeno-principal');
    }

    public function dataFromChild1($data = null)
    {
        $this->dataFromChild1 = $data;
    }

    public function dataFromChild2($data = null)
    {
        $this->dataFromChild2 = $data;
    }

    private function buscarEvaluacion($evaluador, $evaluado, $tipo)
    {
        $metodo = 'evaluadores'.$tipo;
        $busqueda_evaluador = $evaluado->$metodo($this->periodo)->where('evaluador_desempeno_id', $evaluador->id)->first();
        $busqueda_autoevaluador = $evaluado->$metodo($this->periodo)->where('evaluador_desempeno_id', $evaluado->evaluado_desempeno_id)->first();

        if ($busqueda_evaluador || $busqueda_autoevaluador) {
            $prop_evaluado = 'competencias_evaluado';
            $prop_autoevaluado = 'competencias_autoevaluado';

            if ($tipo === 'Objetivos') {
                $prop_evaluado = 'objetivos_evaluado';
                $prop_autoevaluado = 'objetivos_autoevaluado';
            }

            if ($busqueda_evaluador) {
                $this->$prop_evaluado = $busqueda_evaluador->preguntasCuestionario->where('periodo_id', $this->periodo)->sortBy('id');
            }

            if ($busqueda_autoevaluador) {
                $this->$prop_autoevaluado = $busqueda_autoevaluador->preguntasCuestionario->where('periodo_id', $this->periodo)->sortBy('id');
            }
        }
    }

    public function progresoEvaluacion()
    {
        $this->calcularProgreso('competencias_evaluado', 'dataFromChild2');
        $this->calcularProgreso('objetivos_evaluado', 'dataFromChild1');
    }

    private function calcularProgreso($propiedad, $destino)
    {
        if ($this->evaluacionDesempeno->{'activar_'.str_replace('_evaluado', '', $propiedad)}) {
            $total = $this->$propiedad->count();
            $contestadas = $this->$propiedad->where('estatus_calificado', true)->count();

            // Evitar división por cero
            if ($total > 0) {
                $this->$destino = round((($contestadas / $total) * 100), 2);
                if ($this->$destino == 100.0) {
                    $this->$destino = 100;
                }
            } else {
                // Si no hay elementos, asignar 0 al destino
                $this->$destino = 0;
            }
        }
    }
}
