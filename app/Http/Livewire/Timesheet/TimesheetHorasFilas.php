<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
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
        $empleado = Empleado::getAll()->find(auth()->user()->empleado->id);
        $empleadoTimesheetproyecto = TimesheetProyectoEmpleado::getAllByEmpleadoIdNoBloqueado();
        $proyectosRedis = TimesheetProyecto::getAll();
        // areas proyectos
        $proyectos_array = collect();
        $proyectos_totales = $proyectosRedis;
        $proyectoempleado = $empleadoTimesheetproyecto;
        $proyectoempleadoexists = TimesheetProyectoEmpleado::getAllByEmpleadoIdExistsNoBloqueado();
        $filtrope = $empleadoTimesheetproyecto;
        // $comodines = TimesheetProyecto::select('id', 'identificador', 'proyecto')
        // ->where('proyecto', 'LIKE', 'S4B-'.'%')->get();
        $comodines = $proyectosRedis->where('proyecto', 'LIKE', 'S4B-' . '%');
        // dd($comodines);
        // dd(!$filtrope->isEmpty());
        // dd($proyectoempleado);
        if ($proyectoempleadoexists) {
            foreach ($proyectoempleado as $key => $proyecto) {
                if ($proyecto->proyecto->estatus == 'proceso') {
                    if ($proyecto->empleado->id == $empleado->id) {
                        if ($proyecto->empleado->area_id == $empleado->area_id) {
                            $proyectos_array->push([
                                'id' => $proyecto->proyecto["id"],
                                'identificador' => $proyecto->proyecto["identificador"],
                                'proyecto' => $proyecto->proyecto["proyecto"],
                            ]);
                        }
                    }
                }
                foreach ($comodines as $key => $com) {
                    foreach ($proyectos_array as $pay) {
                        if (!($pay['id'] === $com->id)) {
                            $proyectos_array->push([
                                'id' => $com->id,
                                'identificador' => $com->identificador,
                                'proyecto' => $com->proyecto,
                            ]);
                        }
                    }
                }
            }
        } elseif (!$filtrope->isEmpty()) { //Revisar que haya registros en la tabla
            foreach ($proyectos_totales as $key => $proyecto) {
                if ($proyecto->estatus == 'proceso') {
                    foreach ($proyecto->areas as $key => $area) {
                        if (($area['id'] == $empleado->area_id)) {
                            $proyectos_array->push([
                                'id' => $proyecto->id,
                                'identificador' => $proyecto->identificador,
                                'proyecto' => $proyecto->proyecto,
                            ]);
                        }
                    }
                }
            }
            foreach ($filtrope as $key => $fpe) {
                $proyectos_array = $proyectos_array->whereNotIn('id', $fpe->proyecto_id);
            }
            foreach ($comodines as $key => $com) {
                foreach ($proyectos_array as $pay) {
                    if (!($pay['id'] === $com->id)) {
                        $proyectos_array->push([
                            'id' => $com->id,
                            'identificador' => $com->identificador,
                            'proyecto' => $com->proyecto,
                        ]);
                    }
                }
            }
        } else {
            foreach ($proyectos_totales as $key => $proyecto) {
                if ($proyecto->estatus == 'proceso') {
                    foreach ($proyecto->areas as $key => $area) {
                        if (($area['id'] == $empleado->area_id)) {
                            $proyectos_array->push([
                                'id' => $proyecto->id,
                                'identificador' => $proyecto->identificador,
                                'proyecto' => $proyecto->proyecto,
                            ]);
                        }
                    }
                }
            }
        }

        $this->proyectos = $proyectos_array->unique();

        $this->tareas = collect();
        $this->origen = $origen;
        $this->timesheet_id = $timesheet_id;
    }

    public function removerFila()
    {
        // $this->contador = $this->contador - 1;
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
