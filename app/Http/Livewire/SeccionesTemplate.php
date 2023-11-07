<?php

namespace App\Http\Livewire;

use App\Models\Norma;
use Livewire\Component;

class SeccionesTemplate extends Component
{
    public $normas;

    public $preguntas_s1 = [];
    public $preguntas_s2 = [];
    public $preguntas_s3 = [];
    public $preguntas_s4 = [];
    public $secciones = 1;
    public $posicion_seccion = 1;

    public function nextSeccion()
    {
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion >= 1 &&  $this->posicion_seccion < $this->secciones) {
            // dd($this->posicion_seccion);
            // $this->saveDataSeccion1();
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
        $this->preguntas_s1[] = '';
    }

    public function removePreguntaSeccion1($index)
    {
        // dd($index);
        unset($this->preguntas_s1[$index]);
        $this->preguntas_s1 = array_values($this->preguntas_s1);
    }

    public function addPreguntaSeccion2()
    {
        $this->preguntas_s2[] = '';
    }

    public function removePreguntaSeccion2($index)
    {
        // dd($index);
        unset($this->preguntas_s2[$index]);
        $this->preguntas_s2 = array_values($this->preguntas_s2);
    }

    public function addPreguntaSeccion3()
    {
        $this->preguntas_s3[] = '';
    }

    public function removePreguntaSeccion3($index)
    {
        // dd($index);
        unset($this->preguntas_s3[$index]);
        $this->preguntas_s3 = array_values($this->preguntas_s3);
    }

    public function addPreguntaSeccion4()
    {
        $this->preguntas_s4[] = '';
    }

    public function removePreguntaSeccion4($index)
    {
        // dd($index);
        unset($this->preguntas_s4[$index]);
        $this->preguntas_s4 = array_values($this->preguntas_s4);
    }

    public function updatedSecciones($value)
    {
        $this->secciones = $value;
        $this->posicion_seccion = 1;
        // dd($this->secciones);
    }

    public function mount()
    {
        $this->normas = Norma::get();
    }

    public function render()
    {
        return view('livewire.secciones-template')->with("normas", $this->normas);
    }

    public function submitForm($boton, $data)
    {
        // $this->posicion_seccion++;
        dd("submit", $boton, $data);
        // $additional = json_decode($boton, true);
    }

    // public function saveDataSeccion1()
    // {
    //     dd("seccion1");
    // }
}
