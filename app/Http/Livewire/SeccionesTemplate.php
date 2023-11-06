<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SeccionesTemplate extends Component
{

    public $preguntas = [];
    public $secciones = 1;
    public $posicion_seccion = 1;

    public function nextSeccion()
    {
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion >= 1 &&  $this->posicion_seccion < $this->secciones) {
            $this->posicion_seccion++;
        }
    }

    public function backSeccion()
    {
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion > 1 &&  $this->posicion_seccion <= $this->secciones) {
            $this->posicion_seccion--;
        }
    }

    public function addPreguntaSeccion1()
    {
        $this->preguntas[] = '';
    }

    public function removePreguntaSeccion1Seccion1($index)
    {
        // dd($index);
        unset($this->preguntas[$index]);
        $this->preguntas = array_values($this->preguntas);
    }

    public function addPreguntaSeccion2()
    {
        $this->preguntas[] = '';
    }

    public function removePreguntaSeccion1Seccion2($index)
    {
        // dd($index);
        unset($this->preguntas[$index]);
        $this->preguntas = array_values($this->preguntas);
    }

    public function addPreguntaSeccion3()
    {
        $this->preguntas[] = '';
    }

    public function removePreguntaSeccion1Seccion3($index)
    {
        // dd($index);
        unset($this->preguntas[$index]);
        $this->preguntas = array_values($this->preguntas);
    }

    public function addPreguntaSeccion4()
    {
        $this->preguntas[] = '';
    }

    public function removePreguntaSeccion1Seccion4($index)
    {
        // dd($index);
        unset($this->preguntas[$index]);
        $this->preguntas = array_values($this->preguntas);
    }

    public function updatedSecciones($value)
    {
        $this->secciones = $value;
        $this->posicion_seccion = 1;
        // dd($this->secciones);
    }

    public function render()
    {

        return view('livewire.secciones-template');
    }
}
