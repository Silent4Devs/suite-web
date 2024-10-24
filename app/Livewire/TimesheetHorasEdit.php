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

        $this->contador = TimesheetHoras::where('timesheet_id', $this->timesheet_id)->count();
    }

    public function removerFila($id, $tr)
    {
        // dd($id, $tr, $this->contador);
        if ($id != null) {
            TimesheetHoras::find($id)->delete();
        }
        $this->contador--;
        $this->dispatch('removeTr', $tr);
    }

    public function updatedContador($value)
    {
        $this->dispatch('calcularSumatoriasFacturables');
    }

    public function render()
    {
        $this->horas = TimesheetHoras::where('timesheet_id', $this->timesheet_id)->get();

        $this->timesheet = Timesheet::find($this->timesheet_id);

        $this->dispatch('calcularSumatoriasFacturables');

        return view('livewire.timesheet-horas-edit');
    }
}
