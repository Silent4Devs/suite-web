<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EvTrimestralConfigCategorias extends Component
{

    public $categoria = ['', '', ''];

    public function addCategoria()
    {
        // Add an additional empty position
        $this->categoria[] = '';
    }

    public function removeCategoria($keyIndex)
    {
        unset($this->categoria[$keyIndex]);
        $this->categoria = array_values($this->categoria);
    }

    public function render()
    {
        return view('livewire.ev-trimestral-config-categorias');
    }

    public function submitForm($data)
    {
        dd($data);
    }
}
