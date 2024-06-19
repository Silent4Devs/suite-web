<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\EvaluacionDesempeno;
use Livewire\Component;

class EvDesempenoDashboardGeneral extends Component
{
    public $evaluaciones;

    public $contadores = [];

    public $areas;
    public $area_anual = "todas";
    public $area_mensual = "todas";

    public function mount()
    {
        $this->evaluaciones = EvaluacionDesempeno::getAll();
        $this->contadoresEvaluaciones();

        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        return view('livewire.ev-desempeno-dashboard-general');
    }

    public function contadoresEvaluaciones()
    {
        $this->contadores["activo"] = $this->evaluaciones->where('estatus', '=', 1)->count();
        $this->contadores["cerrado"] = $this->evaluaciones->where('estatus', '=', 2)->count();
        $this->contadores["pausado"] = $this->evaluaciones->where('estatus', '=', 3)->count();
    }
}
