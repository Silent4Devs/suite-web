<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Timesheet;
use App\Models\Empleado;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetHoras;

class ReportesProyemp extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $totalRegistrosMostrando;
    public $perPage = 5;
    public $search;
    // public $times;
    public $areas;
    public $area_id = 0;
    public $estatus;
    public $fecha_inicio;
    public $fecha_fin;
    public $emp;
    public $emp_id;
    public $apr;
    public $apr_id;
    public $proy;
    public $proy_id;
    public $empleados_estatus;

    public function mount()
    {
        $this->estatus = null;
        $this->areas = Area::get();
        $this->emp = Empleado::orderBy('name', 'ASC')->get();
        $this->proy = TimesheetProyecto::orderBy('proyecto', 'ASC')->get();

    }

    public function updatedFechaInicio($value)
    {
        $this->fecha_inicio = $value;
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function updatedFechaFin($value)
    {
        $this->fecha_fin = $value;
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    // public function updatedAreaId($value)
    // {
    //     $this->area_id = $value;

    //     // $this->times = Timesheet::whereHas('empleado', function ($query) {
    //     //     if ($this->area_id == 0) {
    //     //         return $query;
    //     //     } else {
    //     //         $query->where('area_id', $this->area_id);
    //     //     }
    //     // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    // }

    public function updatedEmpleadoId($value)
    {
        $this->emp_id = $value;

        // if($this->emp_id != 0)
        // $emp_area = Empleado::select('area_id')->find($this->emp_id);
        // $areas_emp = TimesheetProyectoArea::where('area_id', '=', $emp_area->area_id)->get();
        // $areas = Area::

    }

    public function updatedProyectoId($value)
    {
        $this->proy_id = $value;

    }

    // public function updatedAprobadorId($value)
    // {
    //     $this->apr_id = $value;

    // }

    public function render()
    {
        //Query para obtener los timesheet y filtrarlo
            $query = TimesheetHoras::with('proyecto', 'timesheet', 'tarea.areaData')
            ->whereHas('timesheet', function ($query) {
                if ($this->emp_id == 0){
                    return $query;
                } else {
                    $query->where('empleado_id', $this->emp_id);
                }
            })
            ->whereHas('timesheet', function ($query) {
                    $query->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia');
            })
            ->whereHas('proyecto', function ($query) {
                if ($this->proy_id == 0) {
                    return $query;
                } else {
                    $query->where('proyecto_id', $this->proy_id);
                }
            });

        $this->totalRegistrosMostrando = $query->count();
        $times = $query->paginate($this->perPage);

        // $this->totalRegistrosMostrando = $proyemp->count();

        //Funcion para pintar contadores en los filtros de estatus
        $this->establecerContadores();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-proyemp', compact('times'));
    }

    public function establecerContadores()
    {
        //Contador Todos los registros timesheet
        $this->todos_contador = Timesheet::select('id', 'empleado_id')->whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->count();

        //Contador Todos los registros timesheet en borrador
        $this->borrador_contador = Timesheet::select('id', 'empleado_id')->whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->count();

        //Contador Todos los registros timesheet en penduente
        $this->pendientes_contador = Timesheet::select('id', 'empleado_id')->whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ?
                $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'pendiente')->count();

        //Contador Todos los registros timesheet aprobados
        $this->aprobados_contador = Timesheet::select('id', 'empleado_id')->whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'aprobado')->count();

        //Contador Todos los registros timesheet rechazados
        $this->rechazos_contador = Timesheet::select('id', 'empleado_id')->whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'rechazado')->count();
    }

    public function todos()
    {
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
        $this->estatus = null;
    }

    public function papelera()
    {
        $this->estatus = 'papelera';
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->orderByDesc('fecha_dia')->get();
    }

    public function pendientes()
    {
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'pendiente')->orderByDesc('fecha_dia')->get();
        $this->estatus = 'pendiente';
    }

    public function aprobados()
    {
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'aprobado')->orderByDesc('fecha_dia')->get();
        $this->estatus = 'aprobado';
    }

    public function rechazos()
    {
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'rechazado')->orderByDesc('fecha_dia')->get();
        $this->estatus = 'rechazado';
    }
}
