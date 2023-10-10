<?php

namespace App\Http\Livewire;

use App\Models\Puesto;
use Livewire\Component;

class PuestoSelect extends Component
{
    protected $listeners = ['render-puesto-select' => 'render', 'PuestoStore' => 'PuestoStore'];

    public $puestos;

    public $puestos_seleccionado;

    public function mount($puestos_seleccionado)
    {
        $this->puestos_seleccionado = $puestos_seleccionado;
        $this->puestos = [];
    }

    public function render()
    {
        $this->puestos = Puesto::getAll();

        return view('livewire.puesto-select', ['puestos' => $this->puestos]);
    }

    public function PuestoStore()
    {
        $this->puestos = Puesto::getAll();
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
