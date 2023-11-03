<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SeccionesTemplate extends Component
{

    public $preguntas = [];
    public $secciones = 1;

    public function addPregunta()
    {
        $this->preguntas[] = '';
    }

    public function removePregunta($index)
    {
        // dd($index);
        unset($this->preguntas[$index]);
        $this->preguntas = array_values($this->preguntas);
    }

    public function updatedSecciones($value)
    {
        dd($this->secciones);
    }

    public function render()
    {

        return view('livewire.secciones-template');
    }
}
