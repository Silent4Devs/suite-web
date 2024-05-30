<?php

namespace App\Livewire;

use App\Models\CuestionarioInfraestructuraTecnologica;
use Livewire\Component;

class InfraestructuraTecnologica extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioInfraestructuraTecnologica::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.infraestructura-tecnologica', compact('datas'));
    }
}
