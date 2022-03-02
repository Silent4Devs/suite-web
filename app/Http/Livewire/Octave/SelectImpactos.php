<?php

namespace App\Http\Livewire\Octave;

use Livewire\Component;

class SelectImpactos extends Component
{
    public $OperacionalId;
    public $cumplimiento_id;
    public $legal_id;
    public $reputacional_id;
    public $tecnologico_id;
    public $valor_id;

    public function render()
    {
        return view('livewire.octave.select-impactos');
    }

    public function updatedOperacionalId($value){
        dd("asdasda");
        $this->valor_id + $value;
    }

    public function updatedCumplimientoId($value){
        dd("daslkdaskldnm");
        $this->valor_id + $value;
    }
}
