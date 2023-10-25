<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SeccionesTemplate extends Component
{

    public $secciones = 1;

    public function updatedSecciones($value)
    {
        dd($this->secciones);
    }

    public function render()
    {

        return view('livewire.secciones-template');
    }
}
