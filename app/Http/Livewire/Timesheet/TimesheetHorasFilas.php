<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoArea;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
        $user = User::getCurrentUser();
        $empleado = Empleado::where('id', $user->empleado->id)->first();

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

        $this->tareas = collect();
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
    }

    public function removerFila()
    {
        $this->contador = $this->contador - 1;
        // $this->emit('calcularSumatoriasFacturables');
    }

    public function updatedContador($value)
    {
        $this->emit('calcularSumatoriasFacturables');
    }

    public function render()
    {
        if ($this->origen == 'edit') {
            $this->contador = 2;
            $this->horas = TimesheetHoras::getData()->where('timesheet_id', $this->timesheet_id);
            $this->timesheet = Timesheet::getAll()->find($this->timesheet_id);
        }

        return view('livewire.timesheet.timesheet-horas-filas');
    }
}
