<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CuestionarioEvDesempenoPrincipal extends Component
{
    public $evaluacionDesempeno;
    public $evaluado;
    public $periodo;
    public $acceso_objetivos;
    public $acceso_competencias;


    public function mount($evD, $evld, $per, $ao, $ac)
    {
        $this->evaluacionDesempeno = $evD;
        $this->evaluado = $evld;
        $this->periodo = $per;
        $this->acceso_objetivos = $ao;
        $this->acceso_competencias = $ac;
    }

    public function render()
    {
        return view('livewire.cuestionario-ev-desempeno-principal');
    }
}
