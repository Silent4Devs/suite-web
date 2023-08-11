<?php

namespace App\Http\Livewire;

use App\Models\PlanAuditoriaActividades;
use Livewire\Component;

class TablePlanAuditoriaComponent extends Component
{
    public $plan_auditoria_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = PlanAuditoriaActividades::with('auditado')->where('plan_auditoria_id', '=', $this->plan_auditoria_id)->get();
        // dd($datas[0]);
        return view('livewire.table-plan-auditoria-component', compact('datas'));
    }
}
