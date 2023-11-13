<?php

namespace App\Exports;

use App\Models\TimesheetHoras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteColaboradorTarea implements FromCollection, WithHeadings
{
    public $fecha_inicio;

    public $fecha_fin;

    public $area_id;

    public $emp_id;

    public $proy_id;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(?string $fecha_inicio, ?string $fecha_fin, ?string $area_id, ?string $emp_id, ?string $proy_id)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->area_id = $area_id;
        $this->emp_id = $emp_id;
        $this->proy_id = $proy_id;
    }

    public function collection()
    {
        $query = TimesheetHoras::join('timesheet', 'timesheet.id', '=', 'timesheet_horas.timesheet_id')
            ->join('timesheet_proyectos', 'timesheet_proyectos.id', '=', 'timesheet_horas.proyecto_id')
            ->join('timesheet_tareas', 'timesheet_tareas.id', '=', 'timesheet_horas.tarea_id')
            ->join('empleados as empleados', 'empleados.id', '=', 'timesheet.empleado_id')
            ->join('empleados as aprobadores', 'aprobadores.id', '=', 'timesheet.aprobador_id') // Asumiendo que 'aprobador_id' es el campo correcto

            ->select(
                'timesheet.fecha_dia',
                'empleados.name as empleado_name',
                'aprobadores.name as supervisor_name',
                'timesheet_proyectos.proyecto',
                'timesheet_tareas.tarea',
                'timesheet_horas.descripcion',
                'timesheet_horas.horas_lunes',
                'timesheet_horas.horas_martes',
                'timesheet_horas.horas_miercoles',
                'timesheet_horas.horas_jueves',
                'timesheet_horas.horas_viernes',
                'timesheet_horas.horas_sabado',
                'timesheet_horas.horas_domingo'
            )
            ->where(function ($query) {

                if ($this->fecha_inicio || $this->fecha_fin) {
                    $query->where('timesheet.fecha_dia', '>=', $this->fecha_inicio ?? '1900-01-01')
                        ->where('timesheet.fecha_dia', '<=', $this->fecha_fin ?? now()->format('Y-m-d'))
                        ->orderByDesc('timesheet.fecha_dia');
                }

                if ($this->emp_id != 0) {
                    $query->where('empleados.id', $this->emp_id);
                }

                if ($this->proy_id != 0) {
                    $query->where('timesheet_proyectos.id', $this->proy_id);
                }
                // Otras condiciones que ya tenías
            })
            ->groupBy(
                'timesheet.fecha_dia',
                'empleado_name',
                'supervisor_name',
                'timesheet_proyectos.proyecto',
                'timesheet_tareas.tarea',
                'timesheet_horas.descripcion',
                'timesheet_horas.horas_lunes',
                'timesheet_horas.horas_martes',
                'timesheet_horas.horas_miercoles',
                'timesheet_horas.horas_jueves',
                'timesheet_horas.horas_viernes',
                'timesheet_horas.horas_sabado',
                'timesheet_horas.horas_domingo'
            )
            ->get()
            ->map(function ($timesheetHora) {
                return [
                    'Fecha Día' => \Carbon\Carbon::parse($timesheetHora->fecha_dia)->format('d/m/Y'),
                    'Empleado' => $timesheetHora->empleado_name,
                    'Supervisor' => $timesheetHora->supervisor_name,
                    'Proyecto' => $timesheetHora->proyecto,
                    'Tarea' => $timesheetHora->tarea,
                    'Descripción' => $timesheetHora->descripcion,
                    'Total de Horas' => (floatval($timesheetHora->horas_lunes) + floatval($timesheetHora->horas_martes) + floatval($timesheetHora->horas_miercoles) + floatval($timesheetHora->horas_jueves) + floatval($timesheetHora->horas_viernes) + floatval($timesheetHora->horas_sabado) + floatval($timesheetHora->horas_domingo)),
                ];
            });

        return $query;
    }

    public function headings(): array
    {
        return [
            'Fecha Dia',
            'Empleado',
            'Supervisor',
            'Proyecto',
            'Tarea',
            'Descripción',
            'Total de Horas',
        ];
    }

    public function headingsStyle(): array
    {
        return [
            'font' => [
                'color' => ['rgb' => 'FFFFFF'], // Color del texto (blanco)
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '00FF00'], // Color de fondo (verde)
            ],
        ];
    }
}