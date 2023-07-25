<?php

namespace App\Http\Livewire;

use App\Models\PlanImplementacion;
use Livewire\Component;

class PlanesImplementacionSelect extends Component
{
    protected $listeners = ['render-select' => 'render'];

    public $planes_implementacion;

    public $planes_seleccionados;

    public function mount($planes_seleccionados)
    {
        $this->planes_seleccionados = $planes_seleccionados;
        $this->planes_implementacion = [];
    }

    public function render()
    {
        $this->planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();

        return view('livewire.planes-implementacion-select', ['planes_implementacion' => $this->planes_implementacion]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
