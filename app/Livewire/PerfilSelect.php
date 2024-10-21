<?php

namespace App\Livewire;

use App\Models\PerfilEmpleado;
use Livewire\Component;

class PerfilSelect extends Component
{
    public $perfiles;

    public $perfiles_seleccionado;

    protected $listeners = ['PerfilStore' => 'PerfilStore'];

    public function mount($perfiles_seleccionado)
    {
        $this->perfiles_seleccionado = $perfiles_seleccionado;
        $this->perfiles = [];
    }

    public function render()
    {
        $this->perfiles = PerfilEmpleado::getAll();

        return view('livewire.perfil-select', ['perfiles' => $this->perfiles]);
    }

    public function PerfilStore()
    {
        $this->perfiles = PerfilEmpleado::getAll();
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }
}
