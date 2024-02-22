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
        //$this->areas = Area::getIdNameAll();
        $this->emp = Empleado::getIdNameAll();
        $this->proy = TimesheetProyecto::getIdNameAll();
    }

    public function render()
    {
        $this->refreshComponent();

        // $query = TimesheetHoras::with('proyecto', 'tarea', 'timesheet.empleado')
        // ->withwhereHas('timesheet', function ($query) {
        //     $query->where('estatus', '!=', 'papelera');
        //     if ($this->emp_id != 0) {
        //         $query->where('empleado_id', $this->emp_id);
        //     }
        //     $query->where('fecha_dia', '>', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')
        //         ->where('fecha_dia', '<', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))
        //         ->orderByDesc('fecha_dia');
        // })->withwhereHas('proyecto', function ($query) {
        //     if ($this->proy_id != 0) {
        //         $query->where('id', $this->proy_id);
        //     }
        // });

        $query = TimesheetHoras::join('timesheet', 'timesheet.id', '=', 'timesheet_horas.timesheet_id')
            ->join('timesheet_proyectos', 'timesheet_proyectos.id', '=', 'timesheet_horas.proyecto_id')
            ->join('timesheet_tareas', 'timesheet_tareas.id', '=', 'timesheet_horas.tarea_id')
            ->join('empleados as empleados', 'empleados.id', '=', 'timesheet.empleado_id')
            ->join('empleados as aprobadores', 'aprobadores.id', '=', 'timesheet.aprobador_id')
            ->select(
                'timesheet.*',
                'timesheet.fecha_dia',
                'empleados.name as empleado_name',
                'aprobadores.name as supervisor_name',
                'timesheet_proyectos.proyecto',
                'timesheet_tareas.tarea',
                'timesheet_horas.*',
            )
            ->distinct()
            ->where(function ($query) {

                if ($this->fecha_inicio || $this->fecha_fin) {
                    $query->where('timesheet.fecha_dia', '>=', $this->fecha_inicio ?? '1900-01-01')
                        ->where('timesheet.fecha_dia', '<=', $this->fecha_fin ?? now()->format('Y-m-d'));
                }

                if ($this->emp_id != 0) {
                    $query->where('empleados.id', $this->emp_id);
                }

                if ($this->proy_id != 0) {
                    $query->where('timesheet_proyectos.id', $this->proy_id);
                }
                // Otras condiciones que ya tenías
            })->where('timesheet_proyectos.estatus', '!=', 'papelera')
            ->where('timesheet_proyectos.estatus', '!=', 'rechazado')
            ->where('timesheet_proyectos.estatus', '!=', 'Rechazada')
            ->where('timesheet.estatus', '!=', 'rechazado')
            ->where('timesheet.estatus', '!=', 'papelera')
            ->where('timesheet.estatus', '!=', 'Rechazada')
            ->orderByDesc('fecha_dia');

        $this->totalRegistrosMostrando = $query->count();
        $times = $query->paginate($this->perPage);

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