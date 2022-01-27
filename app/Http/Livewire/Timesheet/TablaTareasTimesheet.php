<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\TimesheetTarea;
use App\Models\TimesheetProyecto;

class TablaTareasTimesheet extends Component
{
    public $tareas;
    public $proyectos;
    public $tarea_name;
    public $proyecto_id;

    public function render()
    {
        $this->tareas = TimesheetTarea::get();
        $this->proyectos = TimesheetProyecto::get();

        return view('livewire.timesheet.tabla-tareas-timesheet');
    }

    public function create()
    {
        $nueva_tarea = TimesheetTarea::create([
            'tarea' => $this->tarea_name,
            'proyecto_id' => $this->proyecto_id,
        ]);
    }
}
