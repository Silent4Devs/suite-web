<?php

namespace App\Livewire;

use App\Models\Amenaza;
use Livewire\Component;

class SelectAmenazaComponent extends Component
{
    public $nombre;

    public $categoria;

    public $descripcion;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $amenazas = Amenaza::orderByDesc('id')->get();

        return view('livewire.select-amenaza-component', compact('amenazas'));
    }

    public function validarAmenaza()
    {
        $this->validate([
            'nombre' => 'required|max:50',
            'categoria' => 'required|max:50',
            'descripcion' => 'required|max:250',
        ]);
    }

    public function save()
    {
        $this->validarAmenaza();
        $model = Amenaza::create([
            'nombre' => $this->nombre,
            'categoria' => $this->categoria,
            'descripcion' => $this->descripcion,
        ]);
        $this->reset('nombre', 'categoria', 'descripcion');
        $this->dispatch('render');
        $this->dispatch('cerrar-modal');
    }
}
