<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PartesInteresadasComponent extends Component
{
    public $clausulas, $norma_id, $parteinteresada;

    public function mount($clausulas)
    {
        $this->clausulas = $clausulas;
    }

    public function render()
    {
        return view('livewire.partes-interesadas-component');
    }

    public function UpdatedNormaId($norma)
    {
        $this->norma_id = $norma;
        $this->parteinteresada = "";
        $this->dispatchBrowserEvent('formulario-updated');
    }
}
