<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\TimesheetProyecto;
use Livewire\Component;

class TablaProyectosTimesheet extends Component
{
    public $proyectos;
    public $proyecto_name;

    public function render()
    {
        $this->proyectos = TimesheetProyecto::get();

        return view('livewire.timesheet.tabla-proyectos-timesheet');
    }

    public function create()
    {
        $nuevo_proyecto = TimesheetProyecto::create([
            'proyecto' => $this->proyecto_name,
        ]);
    }
}
