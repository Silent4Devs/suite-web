<?php

namespace App\Livewire\PlanDeAccion;

use App\Models\PlanImplementacion;
use Livewire\Component;

class PlanAccionIndexComponent extends Component
{
    public $perPage = 5;

    public function render()
    {
        $planImplementacions = PlanImplementacion::where('es_plan_trabajo_base', false)->with('elaborador')->get();

        $planImplementacionsCount = $planImplementacions->count();

        return view('livewire.plan-de-accion.plan-accion-index-component', [
            'planImplementacions' => $planImplementacions,
            'planImplementacionsCount' => $planImplementacionsCount,
        ]);
    }
}
