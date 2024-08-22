<?php

namespace App\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TimesheetProyectoEmpleadosComponent extends Component
{
    use LivewireAlert;

    public $proyecto;

    public $empleados;

    public $proyecto_empleados;

    public $proyecto_id;

    public $empleado_añadido;

    public $horas_asignadas;

    public $costo_hora;

    public $areasempleado;

    public $todos_empleados;

    public $listeners;

    public function mount($proyecto_id)
    {
        $this->proyecto_id = $proyecto_id;
        $this->listeners[] = 'seleccionarTodos';
    }

    public function render()
    {
        $proyecto_id = $this->proyecto_id;
        //Se usa find para buscar dentro y obtener dentro de la coleccion
        $this->proyecto = TimesheetProyecto::getIdNameAll()->where('id', '=', $proyecto_id)->first();

        $areasempleado = DB::table('timesheet_proyectos_areas')
            ->select('id', 'area_id', 'proyecto_id')
            ->where('proyecto_id', $proyecto_id)
            ->get();

        $empleados_Area = [];

        foreach ($areasempleado as $area) {
            //Se usa find para buscar dentro y obtener dentro de la coleccion
            $emps = Area::with('empleadosBasico')->where('id', '=', $area->area_id)->first();

            foreach ($emps->empleadosBasico as $empleado) {
                $empleados_Area[] = [
                    'id' => $empleado->id,
                    'name' => $empleado->name,
                    'seleccionado' => false,
                ];
            }
        }

        $empleados_Area = array_unique($empleados_Area, SORT_REGULAR);

        $this->proyecto_empleados = TimesheetProyectoEmpleado::getProyectosEmpleadosTimesheetProyectosEmpleados()->where('proyecto_id', $proyecto_id);

        //No viable ya que se necesitan usar appends para esta consulta
        // $this->proyecto_empleados = DB::table('timesheet_proyectos_empleados')
        //     ->select(
        //         'timesheet_proyectos_empleados.id',
        //         'timesheet_proyectos_empleados.area_id',
        //         'timesheet_proyectos_empleados.proyecto_id',
        //         'timesheet_proyectos_empleados.costo_hora',
        //         'timesheet_proyectos_empleados.horas_asignadas',
        //         'timesheet_proyectos_empleados.empleado_id',
        //         'timesheet_proyectos_empleados.usuario_bloqueado',
        //         'empleados.name',
        //         'empleados.id as id_empleado',
        //         'areas.area as area',
        //         'puestos.puesto as puesto',
        //         'timesheet_proyectos.proyecto as proyecto'
        //     )
        //     ->join('empleados', 'timesheet_proyectos_empleados.empleado_id', '=', 'empleados.id')
        //     ->join('areas', 'timesheet_proyectos_empleados.area_id', '=', 'areas.id')
        //     ->join('puestos', 'empleados.puesto_id', '=', 'puestos.id')
        //     ->join('timesheet_proyectos', 'timesheet_proyectos_empleados.proyecto_id', '=', 'timesheet_proyectos.id')
        //     ->where('timesheet_proyectos_empleados.proyecto_id', $this->proyecto->id)
        //     ->orderBy('id')
        //     ->get();

        foreach ($empleados_Area as &$empleado) {
            foreach ($this->proyecto_empleados as $proyecto_empleado) {
                if ($empleado['id'] === $proyecto_empleado->empleado_id) {
                    $empleado['seleccionado'] = true;
                    break;
                }
            }
        }

        unset($empleado);
        $empleados_Area = collect($empleados_Area)->sortBy('name')->values()->all();

        $this->empleados = $empleados_Area;

        return view('livewire.timesheet.timesheet-proyecto-empleados-component');
    }

    public function hydrate()
    {
        $this->dispatch('scriptTabla');
    }

    private function resetInput()
    {
        $this->empleado_añadido = null;
        $this->horas_asignadas = null;
        $this->costo_hora = null;
    }

    public function seleccionarTodos()
    {
        foreach ($this->empleados as $empleado) {
            $this->addEmpleadoIndividual($empleado['id']);
        }
    }

    // public function seleccionarTodosExterno()
    // {
    //     foreach ($this->empleados as $empleado) {
    //         $this->addEmpleadoIndividual($empleado['id'], true);
    //     }
    // }

    public function asignacionEmpleados($id_empleado, $key, $asignacion)
    {
        if ($asignacion && $this->proyecto->tipo == 'Externo') {
            $this->empleado_añadido = $id_empleado;
            $this->dispatch('modalProyectosExternos');
        } elseif ($asignacion) {
            $this->addEmpleadoIndividual($id_empleado);
        } else {

            $empleado_proyecto = TimesheetProyectoEmpleado::select(
                'id',
                'proyecto_id',
                'empleado_id'
            )
                ->where('proyecto_id', $this->proyecto->id)
                ->where('empleado_id', $id_empleado)
                ->first();

            $this->dispatch('openModal', empleado_proyecto: $empleado_proyecto->id);
        }
    }

    public function addEmpleado()
    {
        $this->addEmpleadoIndividual($this->empleado_añadido);
    }

    public function addEmpleadoIndividual($empleado_añadido_id, $todosExt = false)
    {
        $empleado_add_proyecto = Empleado::find($empleado_añadido_id);

        if (! $empleado_add_proyecto) {
            return redirect()->route('admin.timesheet-proyecto-empleados', ['proyecto_id' => intval($this->proyecto_id)])
                ->with('error', 'El registro fue eliminado');
        }

        if ($this->proyecto->tipo == 'Externo') {
            if (isset($this->horas_asignadas) && isset($this->costo_hora)) {
                $time_proyect_empleado = TimesheetProyectoEmpleado::firstOrCreate(
                    [
                        'proyecto_id' => $this->proyecto->id,
                        'empleado_id' => $empleado_add_proyecto->id,
                    ],
                    [
                        'area_id' => $empleado_add_proyecto->area_id,
                        'horas_asignadas' => $this->horas_asignadas,
                        'costo_hora' => $this->costo_hora,
                    ]
                );
                $this->dispatch('closeModal');
                if (! $todosExt) {
                    $this->resetInput();
                }
            } else {
                $time_proyect_empleado = TimesheetProyectoEmpleado::firstOrCreate(
                    [
                        'proyecto_id' => $this->proyecto->id,
                        'empleado_id' => $empleado_add_proyecto->id,
                    ],
                    [
                        'area_id' => $empleado_add_proyecto->area_id,
                        'horas_asignadas' => 0,
                        'costo_hora' => 0,
                    ]
                );
            }
        }

        if ($this->proyecto->tipo != 'Externo') {
            $time_proyect_empleado = TimesheetProyectoEmpleado::firstOrCreate(
                [
                    'proyecto_id' => $this->proyecto->id,
                    'empleado_id' => $empleado_add_proyecto->id,
                ],
                [
                    'area_id' => $empleado_add_proyecto->area_id,
                    'horas_asignadas' => 0,
                    'costo_hora' => 0,
                ]
            );
        }

        $this->alert('success', 'Empleado agregado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
        $this->render();
    }

    public function editEmpleado($id, $datos)
    {
        if ($this->proyecto->tipo === 'Externo') {
            if (empty($datos['horas_edit']) || empty($datos['costo_edit']) || empty($datos['empleado_editado'])) {
                $this->alert('error', 'No debe contener datos vacios', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);

                return null;
            } else {
                $emp_upd_proyecto = Empleado::getAltaEmpleados()->find($datos['empleado_editado']);
                $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
                $empleado_edit_proyecto->update([
                    'empleado_id' => $datos['empleado_editado'],
                    'area_id' => $emp_upd_proyecto->area_id,
                    'horas_asignadas' => $datos['horas_edit'],
                    'costo_hora' => $datos['costo_edit'],
                ]);
            }
        } else { //Internos
            $emp_upd_proyecto = Empleado::getAltaEmpleados()->find($datos['empleado_editado']);
            $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
            $empleado_edit_proyecto->update([
                'empleado_id' => $datos['empleado_editado'],
                'area_id' => $emp_upd_proyecto->area_id,
                'horas_asignadas' => 0,
                'costo_hora' => 0,
            ]);
        }

        $this->dispatch('closeModal');
        $this->alert('success', 'Editado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function bloquearEmpleado($id)
    {
        $emp_bloq = TimesheetProyectoEmpleado::find($id);

        if ($emp_bloq->usuario_bloqueado == false) {
            $emp_bloq->usuario_bloqueado = true;
            $emp_bloq->save();
            $this->alert('success', 'El Usuario ha sido Bloqueado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } elseif ($emp_bloq->usuario_bloqueado == true) {
            $emp_bloq->usuario_bloqueado = false;
            $emp_bloq->save();
            $this->alert('success', 'El Usuario ha sido Desloqueado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function empleadoProyectoRemove($id)
    {
        $empleado_remov = TimesheetProyectoEmpleado::find($id);
        $empleado_remov->delete();
    }
}
