<?php

namespace App\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoArea;
use App\Models\User;
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
        $this->dispatch('select2');
    }

    public function mount($origen, $timesheet_id)
    {
        $this->tareas = collect();
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
    }

    public function removerFila()
    {
        $this->contador = $this->contador - 1;
        // $this->dispatch('calcularSumatoriasFacturables');
    }

    public function updatedContador($value)
    {
        $this->dispatch('calcularSumatoriasFacturables');
    }

    public function render()
    {
        $user = User::getCurrentUser();
        $empleado = Empleado::getMyEmpleadodata($user->empleado->id);

        $proyectos_array = collect();

        $proyectos_area = TimesheetProyectoArea::withwhereHas('proyecto', function ($query) {
            return $query->where('estatus', '=', 'proceso');
        })->where('area_id', $empleado->area_id)->orderBy('id', 'desc')->get();

        foreach ($proyectos_area as $pa) {
            $proyectos_array->push(
                $pa->proyecto
            );
        }

        $this->proyectos = $proyectos_array->unique();

        if ($this->origen == 'edit') {
            $this->contador = 2;
            $this->horas = TimesheetHoras::getData()->where('timesheet_id', $this->timesheet_id);
            $this->timesheet = Timesheet::getAll()->find($this->timesheet_id);
        }

        return view('livewire.timesheet.timesheet-horas-filas');
    }
}
