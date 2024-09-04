<?php

namespace App\Http\Livewire;

use App\Models\PlanificacionControlOrigenCambio;
use Livewire\Component;

class OrigenSelectComponent extends Component
{
    protected $listeners = ['render-origen-select-component' => 'render'];

    public $origenes;

    public $origen_seleccionado;

    public function mount($origen_seleccionado = null)
    {
        $this->origen_seleccionado = $origen_seleccionado;
        $this->origenes = [];
    }

    public function render()
    {
        $this->origenes = PlanificacionControlOrigenCambio::get();

        return view('livewire.origen-select-component', ['origenes' => $this->origenes]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
