<?php

namespace App\Livewire;

use App\Models\MatrizOctaveServicio;
use Livewire\Component;

class ServicioSelectComponent extends Component
{
    protected $listeners = ['render-servicio-select-component' => 'render'];

    public $servicios;

    public $servicio_seleccionado;

    public function mount($servicio_seleccionado = null)
    {
        $this->servicio_seleccionado = $servicio_seleccionado;
        $this->servicios = [];
    }

    public function render()
    {
        $this->servicios = MatrizOctaveServicio::get();

        return view('livewire.servicio-select-component', ['servicios' => $this->servicios]);
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }
}
