<?php

namespace App\Livewire;

use App\Models\TipoDePermiso;
use Illuminate\Support\Str;
use Livewire\Component;

class PermisoComponent extends Component
{
    public $nombre;

    public $descripcion;

    protected $rules = [
        'nombre' => 'required|string|max:255',
    ];

    protected $mesages = [
        'nombre.required' => 'Debes de definir un nombre para el tipo',

    ];

    public function save()
    {
        $this->validate();
        TipoDePermiso::create([
            'nombre' => $this->nombre,
            'slug' => Str::slug($this->nombre, '-'),
            'descripcion' => $this->descripcion,
        ]);
        $this->dispatch('tipoStore');
        $this->dispatch('render-tipo-permiso-select-component');
    }

    public function render()
    {
        return view('livewire.permiso-component');
    }
}
