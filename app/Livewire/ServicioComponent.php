<?php

namespace App\Livewire;

use App\Models\MatrizOctaveServicio;
use Carbon\Carbon;
use Livewire\Component;

class ServicioComponent extends Component
{
    public $servicio;

    public $descripcion;

    protected $rules = [
        'servicio' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:1500',
    ];

    protected $mesages = [
        'servicio.required' => 'Debes de definir un nombre para el servicio',
        'servicio.max' => 'El tipo de servicio no debe exceder los 255 carácteres',
        'descripcion.max' => 'La descripción no debe exceder los 1500 carácteres',
    ];

    public function save()
    {
        $this->validate();
        MatrizOctaveServicio::create([
            'servicio' => $this->servicio,
            'descripcion' => $this->descripcion,
            'created_at' => Carbon::now(),
        ]);
        $this->dispatch('servicioStore');
        $this->dispatch('render-servicio-select-component');
    }

    public function render()
    {
        return view('livewire.servicio-component');
    }
}
