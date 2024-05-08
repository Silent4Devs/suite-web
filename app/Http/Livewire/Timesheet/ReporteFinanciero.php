<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
use Livewire\Component;

class ReporteFinanciero extends Component
{
    public $proyectos;
    public $empleados = [];

    public function render()
    {
        $this->proyectos = TimesheetProyecto::getAllWithData();
        $this->proyectos = $this->proyectos->sortByDesc('is_num');
        return view('livewire.timesheet.reporte-financiero');
    }

    public function renderTable($value){
        $proyectos = TimesheetProyecto::getAll($value);
        $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $value)->get();
        // foreach ($ids_emp as $emp_p) {
        //     $empleados = Empleado::select('id', 'name')->where('id', $emp_p->empleado_id)->first();
        //     dd($empleados);
        // } 
        dd($value,$proyectos[0],$ids_emp);
    }
}
