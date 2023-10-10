<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Timesheet;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ReportesRegistros extends Component
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

    public function mount()
    {
        $this->estatus = null;
        $this->areas = Area::getAll();
        // $this->emp = Empleado::alta()->orderBy('name', 'ASC')->get();
    }

    public function updatedFechaInicio($value)
    {
        $fi = Carbon::parse($value)->format('Y-m-d');
        $this->fecha_inicio = $fi;
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
        $ff = Carbon::parse($value)->format('Y-m-d');
        $this->fecha_fin = $ff;
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function updatedAreaId($value)
    {
        if ($value == 0) {
            $this->area_id = $value;
            $this->emp = 0;
        } else {
            $this->area_id = $value;
        }

        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function updatedEmpleadoId($value)
    {
        $this->emp_id = $value;

        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function render()
    {
        //Query para obtener los timesheet y filtrarlo
        if ($this->area_id == 0) {
            $this->emp = Empleado::getAll(['orderBy' => ['name', 'ASC']]);
        } else {
            $this->emp = Empleado::getAll(['orderBy' => ['name', 'ASC']])->where('area_id', $this->area_id)->where('estatus', 'alta');
        }
        $empleados = $this->emp;

        $query = Timesheet::orderByDesc('fecha_dia')
            ->whereHas('empleado', function ($query) {
                if ($this->emp_id == 0) {
                    return $query->where('name', 'ILIKE', "%{$this->search}%");
                } else {
                    $query->where('id', $this->emp_id)->where('name', 'ILIKE', "%{$this->search}%");
                }
            })
            ->whereHas('empleado', function ($query) {
                if ($this->area_id == 0) {
                    return $query->where('name', 'ILIKE', "%{$this->search}%");
                } else {
                    $query->where('area_id', $this->area_id)->where('name', 'ILIKE', "%{$this->search}%");
                }
            })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia');

        if ($this->estatus) {
            $query = $query->where('estatus', $this->estatus);
        }
        $this->totalRegistrosMostrando = $query->count();
        $times = $query->paginate($this->perPage);

        //Funcion para pintar contadores en los filtros de estatus
        $this->establecerContadores();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-registros', compact('times', 'empleados'));
    }

    public function establecerContadores()
    {
        //Contador Todos los registros timesheet
        //$this->todos_contador = Timesheet::select('id', 'empleado_id')->whereHas('empleado', function ($query) {
        $this->todos_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->count();

        //Contador Todos los registros timesheet en borrador
        $this->borrador_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->count();

        //Contador Todos los registros timesheet en penduente
        $this->pendientes_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ?
                $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'pendiente')->count();

        //Contador Todos los registros timesheet aprobados
        $this->aprobados_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'aprobado')->count();

        //Contador Todos los registros timesheet rechazados
        $this->rechazos_contador = Timesheet::whereHas('empleado', function ($query) {
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
