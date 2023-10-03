<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\User;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;

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
        $empleado = User::getCurrentUser()->empleado;
        $proyectos = $empleado->TimesheetProyectoEmpleado;
        // dd($proyectos);
        $proyectoempleado = TimesheetProyectoEmpleado::getAllByEmpleadoIdNoBloqueado($empleado->id);
        $proyectoempleadoexists = TimesheetProyectoEmpleado::getAllByEmpleadoIdExistsNoBloqueado($empleado->id);
        $comodines = TimesheetProyecto::select('id', 'identificador', 'proyecto')->where('proyecto', 'LIKE', 'S4B-' . '%')->get();
        $proyectos_totales = TimesheetProyecto::getAll();
        // areas proyectos
        //to do Cambiar a array
        // dd($comodines);
        $proyectos_array = collect();
        $proyectos_array = $comodines;
        // dd($proyectos_array);
        if (!$proyectos->isEmpty()) {
            foreach ($proyectos as $key => $proyecto) {
                $proyectos_array->push(
                    $proyecto->proyecto
                );
            }
            // dd('dentro del if', $proyectos_array);
        } else {
            $proyectos_area = TimesheetProyectoArea::with('proyecto')->where('area_id', $empleado->area_id)->get();
            //Traer todos los proyectos que ya han sido asignados en el area
            $proyectos_filtro = TimesheetProyectoEmpleado::where('area_id', $empleado->area_id)->get();
            //foreach borramos los proyectos del area que ya han sido asignados
            //$proyectos_array = $proyectos_array->whereNotIn('id', $fpe->proyecto_id);
            foreach ($proyectos_area as $pa) {
                // dd($pa->proyectosAsignados);
                $proyectos_array->push(
                    $pa->proyecto
                );
            }
            foreach ($proyectos_filtro as $key => $fpe) {
                $proyectos_array = $proyectos_array->whereNotIn('id', $fpe->proyecto_id);
            }
            // dd('dentro del else',$proyectos_array);
        }
        // dd($proyectos_array);
        // $comodines = TimesheetProyecto::select('id', 'identificador', 'proyecto')
        // ->where('proyecto', 'LIKE', 'S4B-'.'%')->get();
        //Todos los usuarios deben poder ver los comodines
        //La consulta de comodines debe venir en un cache
        //Los comodines deben estar en un catalogo
        //Si no estas asignado a un proyecto se muestran todos los proyectos del area
        //Al asignarse a un proyecto solo podra ver los proyectos asignados y los comodines
        //No se podran visualizar los proyectos a los que ya han sido asignadosa otros usuarios
        // if ($proyectoempleadoexists) {
        //     foreach ($proyectoempleado as $key => $proyecto) {
        //         if ($proyecto->proyecto->estatus == 'proceso') {
        //             if ($proyecto->empleado->id == $empleado->id) {
        //                 if ($proyecto->empleado->area_id == $empleado->area_id) {
        //                     $proyectos_array->push([
        //                         'id' => $proyecto->proyecto["id"],
        //                         'identificador' => $proyecto->proyecto["identificador"],
        //                         'proyecto' => $proyecto->proyecto["proyecto"],
        //                     ]);
        //                 }
        //             }
        //         }
        //         foreach ($comodines as $key => $com) {
        //             foreach ($proyectos_array as $pay) {
        //                 if (!($pay['id'] === $com->id)) {
        //                     $proyectos_array->push([
        //                         'id' => $com->id,
        //                         'identificador' => $com->identificador,
        //                         'proyecto' => $com->proyecto,
        //                     ]);
        //                 }
        //             }
        //         }
        //         // dd($proyectos_array);
        //     }
        // } elseif (!$proyectoempleado->isEmpty()) { //Revisar que haya registros en la tabla
        //     foreach ($proyectos_totales as $key => $proyecto) {
        //         if ($proyecto->estatus == 'proceso') {
        //             foreach ($proyecto->areas as $key => $area) {
        //                 if (($area['id'] == $empleado->area_id)) {
        //                     $proyectos_array->push([
        //                         'id' => $proyecto->id,
        //                         'identificador' => $proyecto->identificador,
        //                         'proyecto' => $proyecto->proyecto,
        //                     ]);
        //                 }
        //             }
        //         }
        //     }
        //     foreach ($filtrope as $key => $fpe) {
        //         $proyectos_array = $proyectos_array->whereNotIn('id', $fpe->proyecto_id);
        //     }
        //     foreach ($comodines as $key => $com) {
        //         foreach ($proyectos_array as $pay) {
        //             if (!($pay['id'] === $com->id)) {
        //                 $proyectos_array->push([
        //                     'id' => $com->id,
        //                     'identificador' => $com->identificador,
        //                     'proyecto' => $com->proyecto,
        //                 ]);
        //             }
        //         }
        //     }
        // } else {
        //     foreach ($proyectos_totales as $key => $proyecto) {
        //         if ($proyecto->estatus == 'proceso') {
        //             foreach ($proyecto->areas as $key => $area) {
        //                 if (($area['id'] == $empleado->area_id)) {
        //                     $proyectos_array->push([
        //                         'id' => $proyecto->id,
        //                         'identificador' => $proyecto->identificador,
        //                         'proyecto' => $proyecto->proyecto,
        //                     ]);
        //                 }
        //             }
        //         }
        //     }
        // }

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
