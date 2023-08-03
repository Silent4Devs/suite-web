<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BarraProgresoComponent extends Component
{
    protected $listeners = [
        'actualizarProgreso',
    ];

    public $progreso;

    public function mount()
    {
        $this->progreso = 0;
    }

    public function render()
    {
        return view('livewire.barra-progreso-component');
    }

    public function actualizarProgreso($progreso)
    {
        return $this->progreso = $progreso;
    }
}
