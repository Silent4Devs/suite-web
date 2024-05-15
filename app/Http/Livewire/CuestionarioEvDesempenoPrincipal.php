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

        if ($evaluado->empleado->id == $evaluador->id) {
            $this->autoevaluacion = true;
        }
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

    public function render()
    {
        return view('livewire.cuestionario-ev-desempeno-principal');
    }
}
