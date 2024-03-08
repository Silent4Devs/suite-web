<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateEvaluacionDesempeno extends Component
{
    public $paso = 1;
    public $nombre_evaluacion = null;
    public $descripcion_evaluacion = null;
    public $activar_objetivos = false;
    public $porcentaje_objetivos = 50;
    public $activar_competencias = false;
    public $porcentaje_competencias = 50;

    public function render()
    {
        return view('livewire.create-evaluacion-desempeno');
    }

    public function primerPaso()
    {
        // dd(
        //     '1',
        //     $this->nombre_evaluacion,
        //     $this->descripcion_evaluacion,
        //     $this->activar_objetivos,
        //     $this->porcentaje_objetivos,
        //     $this->activar_competencias,
        //     $this->porcentaje_competencias,
        // );

        $datosPaso1 = [
            'nombre' => $this->nombre_evaluacion,
            'descripcion' => $this->descripcion_evaluacion,
            'activar_objetivos' => $this->activar_objetivos,
            'porcentaje_objetivos' => $this->porcentaje_objetivos,
            'activar_competencias' => $this->activar_competencias,
            'porcentaje_competencias' => $this->porcentaje_competencias,
        ];

        $this->paso++;
    }
}
