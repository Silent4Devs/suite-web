<?php

namespace App\Livewire;

use App\Models\PlanificacionControlOrigenCambio;
use Livewire\Component;

class OrigenCambioComponent extends Component
{
    public $nombre;

    public $descripcion;

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'nullable',
    ];

    protected $messages = [
        'nombre.required' => 'Debes definir un nombre para el origen de cambio',

    ];

    public function save()
    {
        $this->validate();
        PlanificacionControlOrigenCambio::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        $this->dispatch('OrigenCambioStore');
        $this->dispatch('render-origen-select-component');
    }

    public function render()
    {
        return view('livewire.origen-cambio-component');
    }
}
