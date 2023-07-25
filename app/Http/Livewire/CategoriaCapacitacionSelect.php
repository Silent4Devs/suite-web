<?php

namespace App\Http\Livewire;

use App\Models\CategoriaCapacitacion;
use Livewire\Component;

class CategoriaCapacitacionSelect extends Component
{
    protected $listeners = ['render-categorias-capacitacion-select' => 'render'];

    public $categorias;

    public $categoria_seleccionada;

    public function mount($categoria_seleccionada)
    {
        $this->categoria_seleccionada = $categoria_seleccionada;
        $this->categorias = [];
    }

    public function render()
    {
        $this->categorias = CategoriaCapacitacion::get();

        return view('livewire.categoria-capacitacion-select', [
            'categorias' => $this->categorias,
        ]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
