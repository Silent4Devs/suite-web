<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TablaTareasTimesheet extends Component
{
    use LivewireAlert;

    public $tareas;
    public $proyectos;
    public $proyecto_seleccionado;
    public $tarea_name;
    public $proyecto_id;
    public $origen;
    public $tareas_proyecto;

    public function mount($proyecto_id, $origen)
    {
        $this->origen = $origen;
        $this->proyecto_id = $proyecto_id;
    }

    public function render()
    {
        if ($this->origen == 'tareas') {
            $this->proyectos = TimesheetProyecto::get();
            $this->tareas = TimesheetTarea::get();
        }

        if ($this->origen == 'tareas-proyectos') {
            $this->proyecto_seleccionado = TimesheetProyecto::find($this->proyecto_id);
            $this->tareas_proyecto = TimesheetTarea::where('proyecto_id', $this->proyecto_id)->get();
        }

        $this->emit('scriptTabla');

        return view('livewire.timesheet.tabla-tareas-timesheet');
    }

    public function create()
    {
        $this->validate([
            'tarea_name'=>'required',
            'proyecto_id'=>'required',
        ]);

        $nueva_tarea = TimesheetTarea::create([
            'tarea' => $this->tarea_name,
            'proyecto_id' => $this->proyecto_id,
        ]);

        $this->alert('success', 'Registro añadido!');
    }

    public function destroy($id)
    {
        TimesheetTarea::destroy($id);

        $this->alert('success', 'Registro eliminado!');
    }
}
