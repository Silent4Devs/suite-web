<?php

namespace App\Livewire;

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
        $this->dispatch('select2');
    }

    public function mount($proyectos, $tareas, $origen, $timesheet_id)
    {
        $this->proyectos = $proyectos;
        $this->tareas = $tareas;
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
    }

    public function removerFila($id, $tr)
    {
        if ($id != null) {
            $hora_eliminada = TimesheetHoras::find($id);
            $hora_eliminada->delete();

            $this->dispatch('removeTr', $tr);
        }
    }

    public function updatedContador($value)
    {
        $this->dispatch('calcularSumatoriasFacturables');
    }

    public function render()
    {
        $this->horas = TimesheetHoras::getData()->where('timesheet_id', $this->timesheet_id);
        $this->timesheet = Timesheet::find($this->timesheet_id);

        $this->dispatch('calcularSumatoriasFacturables');

        return view('livewire.timesheet-horas-edit');
    }
}
