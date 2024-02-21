<?php

namespace App\Http\Livewire\Timesheet;

use App\Exports\ReporteColaboradorRegistro;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Timesheet;
use Carbon\Carbon;
use Excel;
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
    }

    public function updatedFechaInicio($value)
    {
        $fi = Carbon::parse($value)->format('Y-m-d');
        $this->fecha_inicio = $fi;
    }

    public function updatedFechaFin($value)
    {
        $ff = Carbon::parse($value)->format('Y-m-d');
        $this->fecha_fin = $ff;
    }

    public function updatedAreaId($value)
    {
        if ($value == 0) {
            $this->area_id = $value;
            $this->emp = 0;
        } else {
            $this->area_id = $value;
        }
    }

    public function updatedEmpleadoId($value)
    {
        $this->emp_id = $value;
    }

    public function render()
    {
        $this->areas = Area::getIdNameAll();
        //Query para obtener los timesheet y filtrarlo
        if ($this->area_id == 0) {
            $this->emp = Empleado::select('id', 'name')->where('estatus', 'alta')->orderBy('id', 'desc')->get();
        } else {
            $this->emp = Empleado::select('id', 'name')->where('estatus', 'alta')->where('area_id', $this->area_id)->orderBy('id', 'desc')->get();
        }
        $empleados = $this->emp;

        $query = Timesheet::select(
            'id',
            'fecha_dia',
            'empleado_id',
            'aprobador_id',
            'estatus',
            'comentarios',
            'dia_semana',
            'inicio_semana',
            'fin_semana',
        )
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
            })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))
            ->where('estatus', '!=', 'papelera')
            ->orderByDesc('fecha_dia');

        if ($this->estatus) {
            $query = $query->where('estatus', $this->estatus);
        }
        $this->totalRegistrosMostrando = $query->count();

        $times = $query->fastPaginate($this->perPage);

        if ($this->emp_id || $this->area_id || $this->fecha_fin || $this->fecha_inicio) {
            $timesExcel = $query->paginate($query->count());
        } else {
            $timesExcel = null;
        }

        //Funcion para pintar contadores en los filtros de estatus
        $this->establecerContadores();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-registros', compact('timesExcel', 'times', 'empleados'));
    }

    public function exportExcel()
    {

        $export = new ReporteColaboradorRegistro($this->fecha_inicio, $this->fecha_fin, $this->area_id, $this->emp_id);

        return Excel::download($export, 'reporte_colaborador_registro.xlsx');
    }

    public function establecerContadores()
    {
        //Contador Todos los registros timesheet
        $querybase = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        });

        $this->todos_contador = $querybase
            ->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->count();

        // //Contador Todos los registros timesheet en borrador
        // $this->borrador_contador = $querybase->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->count();

        // //Contador Todos los registros timesheet en penduente
        $this->pendientes_contador = $querybase->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ?
            $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'pendiente')->count();

        //Contador Todos los registros timesheet aprobados
        $this->aprobados_contador = $querybase->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'aprobado')->count();

        //Contador Todos los registros timesheet rechazados
        $this->rechazos_contador = $querybase->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'rechazado')->count();
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

    // public function papelera()
    // {
    //     $this->estatus = 'papelera';
    //     // $this->times = Timesheet::whereHas('empleado', function ($query) {
    //     //     if ($this->area_id == 0) {
    //     //         return $query;
    //     //     } else {
    //     //         $query->where('area_id', $this->area_id);
    //     //     }
    //     // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->orderByDesc('fecha_dia')->get();
    // }

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

    public function dropDuplicate()
    {
        $times = Timesheet::select('fecha_dia', 'empleado_id')
            ->groupBy('fecha_dia', 'empleado_id')
            ->havingRaw('COUNT(*) > 1')
            ->orderBy('empleado_id')
            ->get();

        // dd($times->pluck('empleado_id', 'fecha_dia'));

        $tiemDup = collect();
        foreach ($times as $tf) {
            $tiemDup->push([
                'empleado_id' => $tf->empleado_id,
                'name' => $tf->empleado->name,
                'fecha_dia' => $tf->fecha_dia,
                'inicio' => $tf->inicio,
            ]);
        }

        foreach ($tiemDup as $td) {

            $deletedDup = Timesheet::where('empleado_id', $td['empleado_id'])
                ->where('fecha_dia', $td['fecha_dia'])
                ->get();
            $countDeleted = 0;
            foreach ($deletedDup as $del) {
                if ($countDeleted > 0) {
                    $del->delete();
                }
                $countDeleted = $countDeleted + 1;
            }
            // dump($td['name'] . ' | ' . $td['inicio'] . ' | ' .  $deletedDup->count());
        }
    }
}
