<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use Livewire\Component;

class TimesheetHorasFilas extends Component
{
    public $proyectos;
    public $tareas;
    public $horas;
    public $origen;
    public $timesheet;
    public $timesheet_id;
    public $contador = 5;

    protected $listeners = ['removerFila'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount($origen, $timesheet_id)
    {
        $empleado = Empleado::find(auth()->user()->empleado->id);
        $this->proyectos = TimesheetProyecto::where('area_id', $empleado->area_id)->get();
        $this->tareas = collect();
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
    }

    public function removerFila()
    {
        $this->contador = $this->contador - 1;
        $this->emit('calcularSumatoriasFacturables');
    }

    public function updatedContador($value)
    {
        $this->emit('calcularSumatoriasFacturables');
    }

    public function render()
    {
        if ($this->origen == 'edit') {
            $this->contador = 2;
            $this->horas = TimesheetHoras::where('timesheet_id', $this->timesheet_id)->get();
            $this->timesheet = Timesheet::find($this->timesheet_id);
        }

        return view('livewire.timesheet.timesheet-horas-filas');
    }
}
