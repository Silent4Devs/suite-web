<?php

namespace App\Http\Livewire;

use App\Models\RH\TipoObjetivo;
use Livewire\Component;

class TipoObjetivosSelect extends Component
{
    protected $listeners = ['render-tipo-objetivo-select' => 'render'];

    public $tipos;

    public $tipo_seleccionado;

    public function mount($tipo_seleccionado)
    {
        $this->tipo_seleccionado = $tipo_seleccionado;
        $this->tipos = [];
    }

    public function render()
    {
        $this->tipos = TipoObjetivo::getAll();

        return view('livewire.tipo-objetivos-select', ['tipos' => $this->tipos]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
