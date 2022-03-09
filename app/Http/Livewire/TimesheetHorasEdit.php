<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;

class TimesheetHorasEdit extends Component
{
    
    public $proyectos;
    public $tareas;
    public $horas;
    public $origen;
    public $timesheet;
    public $timesheet_id;
    public $contador;

    public function mount($proyectos, $tareas, $origen, $timesheet_id)
    {
        $this->proyectos = $proyectos;
        $this->tareas = $tareas;
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
    }

    public function render()
    {
        $this->horas = TimesheetHoras::where('timesheet_id', $this->timesheet_id)->get();
        $this->timesheet = Timesheet::find($this->timesheet_id);

        return view('livewire.timesheet-horas-edit');
    }

    public function agregarFila()
    {
        $this->contador = $this->contador + 1;
        $this->emit('filaAgregada'); 
    }
}
