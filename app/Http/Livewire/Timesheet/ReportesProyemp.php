<?php

namespace App\Http\Livewire\Timesheet;

use App\Exports\ReporteColaboradorTarea;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ReportesProyemp extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $totalRegistrosMostrando;

    public $perPage = 5;

    public $search;

    public $areas;

    public $area_id = 0;

    public $estatus;

    public $fecha_inicio;

    public $fecha_fin;

    public $emp;

    public $emp_id;

    public $proy;

    public $proy_id;

    public $empleados_estatus;

    public function mount()
    {
        $this->estatus = null;
    }

    public function updatedFechaInicio($value)
    {
        $this->fecha_inicio = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function updatedFechaFin($value)
    {
        $this->fecha_fin = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function updatedEmpleadoId($value)
    {
        $this->emp_id = $value;
    }

    public function updatedProyectoId($value)
    {
        $this->proy_id = $value;
    }

    public function refreshComponent()
    {
        $this->areas = Area::getAll();
        $this->emp = Empleado::getIdNameAll();
        $this->proy = TimesheetProyecto::getIdNameAll();
    }

    public function render()
    {
        $this->refreshComponent();

        $query = TimesheetHoras::with('proyecto', 'tarea', 'timesheet.empleado')
        ->withwhereHas('timesheet', function ($query) {
            $query->where('estatus', '!=', 'papelera');
            if ($this->emp_id != 0) {
                $query->where('empleado_id', $this->emp_id);
            }
            $query->where('fecha_dia', '>', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')
                ->where('fecha_dia', '<', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))
                ->orderByDesc('fecha_dia');
        })->withwhereHas('proyecto', function ($query) {
            if ($this->proy_id != 0) {
                $query->where('id', $this->proy_id);
            }
        });

        $this->totalRegistrosMostrando = $query->count();
        $times = $query->fastPaginate($this->perPage);

        return view('livewire.timesheet.reportes-proyemp', compact('times'));
    }

    public function exportExcel()
    {
        $export = new ReporteColaboradorTarea($this->fecha_inicio, $this->fecha_fin, $this->area_id, $this->emp_id, $this->proy_id);

        return Excel::download($export, 'reporte_colaborador_tarea.xlsx');
    }

    public function todos()
    {
        $this->estatus = null;
    }

    public function papelera()
    {
        $this->estatus = 'papelera';
    }

    public function pendientes()
    {
        $this->estatus = 'pendiente';
    }

    public function aprobados()
    {
        $this->estatus = 'aprobado';
    }

    public function rechazos()
    {
        $this->estatus = 'rechazado';
    }
}
