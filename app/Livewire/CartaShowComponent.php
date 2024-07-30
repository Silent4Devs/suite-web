<?php

namespace App\Livewire;

use Livewire\Component;

class CartaShowComponent extends Component
{
    public $procesoId;

    public $proceso_data;

    public $operacional;

    public $legal;

    public $cumplimiento;

    public $reputacional;

    public $tecnologico;

    public $activos;

    public $escenarios;

    public $operacionalTxt;

    public $legalTxt;

    public $cumplimientoTxt;

    public $reputacionalTxt;

    public $tecnologicoTxt;

    public $impacto;

    public $probabilidad;

    public $promedioDisponibilidad = [];

    public $promedioIntegridad = [];

    public $promedioConfidencialidad = [];

    public $coordenada_tabla = '4,5';

    public function render()
    {
        return view('livewire.carta-show-component');
    }
}
