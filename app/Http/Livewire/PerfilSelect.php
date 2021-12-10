<?php

namespace App\Http\Livewire;

use App\Models\PerfilEmpleado;
use Livewire\Component;

class PerfilSelect extends Component
{
    protected $listeners = ['render-perfil-select' => 'render'];
    public $perfiles;
    public $perfiles_seleccionado;

    public function mount($perfiles_seleccionado)
    {
        $this->perfiles_seleccionado = $perfiles_seleccionado;
        $this->perfiles = [];
    }

    public function render()
    {
        $this->perfiles = PerfilEmpleado::get();
        return view('livewire.perfil-select', ['perfiles' => $this->perfiles]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
