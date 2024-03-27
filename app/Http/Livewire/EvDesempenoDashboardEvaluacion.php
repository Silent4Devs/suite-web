<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\EvaluacionDesempeno;
use Livewire\Component;

class EvDesempenoDashboardEvaluacion extends Component
{
    public $id_evaluacion;
    public $evaluacion;

    public $areas;

    public function mount($id_evaluacion)
    {
        $this->id_evaluacion = $id_evaluacion;
        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        // dd($this->evaluacion->total_evaluaciones);
        return view('livewire.ev-desempeno-dashboard-evaluacion');
    }

    public function cerrarEvaluacion()
    {
        $this->evaluacion->update(
            [
                'estatus' => 2,
            ]
        );
    }
}
