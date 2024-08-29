<?php

namespace App\Http\Livewire;

use App\Models\TipoDePermiso;
use Livewire\Component;

class TipoPermisoSelectComponent extends Component
{
    protected $listeners = ['render-tipo-permiso-select-component' => 'render'];

    public $tipos;

    public $tipo_seleccionado;

    public function mount($tipo_seleccionado = null)
    {
        $this->tipo_permiso_seleccionado = $tipo_seleccionado;
        $this->tipos = [];
    }

    public function render()
    {
        $this->tipos = TipoDePermiso::get();

        return view('livewire.tipo-permiso-select-component', ['tipos' => $this->tipos]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
