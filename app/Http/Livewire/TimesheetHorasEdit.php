<?php

namespace App\Http\Livewire;

use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use Livewire\Component;

class TimesheetHorasEdit extends Component
{
    public $proyectos;

    public $tareas;

    public $horas;

    public $origen;

    public $timesheet;

    public $timesheet_id;

    public $contador;

    public $horas_excluidas;

    protected $listeners = ['removerFila'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount($proyectos, $tareas, $origen, $timesheet_id)
    {
        $this->proyectos = $proyectos;
        $this->tareas = $tareas;
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
        $this->horas = TimesheetHoras::where('timesheet_id', $this->timesheet_id)->get();
    }

    public function removerFila($id)
    {
        if ($id != null) {
            $this->horas_excluidas[] = $id;
            $this->horas = $this->horas->except($this->horas_excluidas);
        }
        $this->emit('calcularSumatoriasFacturables');
    }

    public function updatedContador($value)
    {
        $this->emit('calcularSumatoriasFacturables');
    }

    public function render()
    {
        $this->timesheet = Timesheet::find($this->timesheet_id);

        return view('livewire.timesheet-horas-edit');
    }
}
