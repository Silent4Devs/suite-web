<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\Empleado;

class ReporteAprobador extends Component
{
    public $empleados_children;
    public $aprobador;

    public function render()
    {
        $this->aprobador = Empleado::find(auth()->user()->empleado->id);
        $this->empleados_children = $this->aprobador->children;
        
        return view('livewire.timesheet.reporte-aprobador');
    }
}
