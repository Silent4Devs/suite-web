<?php

namespace App\Http\Livewire\PlanDeAccion;

use Livewire\Component;
use App\Models\PlanImplementacion;
use Illuminate\Support\Facades\Cache;

class PlanAccionIndexComponent extends Component
{
    public $perPage = 5;
    public function render()
    {
        $planImplementacions = PlanImplementacion::where('es_plan_trabajo_base', false)->with('elaborador')->get();

        $planImplementacionsCount = $planImplementacions->count();

        return view('livewire.plan-de-accion.plan-accion-index-component',[
            'planImplementacions' => $planImplementacions,
            'planImplementacionsCount' => $planImplementacionsCount
        ]);
    }
}
