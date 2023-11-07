<?php

namespace App\Exports;

use App\Models\TimesheetHoras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;


class ReporteColaboradorTarea implements FromCollection, WithHeadings
{
    public  $fecha_inicio;
    public  $fecha_fin;
    public  $area_id;
    public  $emp_id;
    public  $proy_id;
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
        //query
        $query = TimesheetHoras::with('proyecto', 'tarea', 'timesheet.empleado')->withwhereHas('timesheet', function ($query) {
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
        })->get()->map(function ($timesheetHora) {
            return [
                'Fecha Día' =>  \Carbon\Carbon::parse($timesheetHora->timesheet->fecha_dia)->format('d/m/Y'),
                'Empleado' => $timesheetHora->timesheet->empleado->name,
                'Supervisor' => $timesheetHora->timesheet->aprobador->name,
                'Proyecto' => $timesheetHora->proyecto->proyecto,
                'Tarea' => $timesheetHora->tarea->tarea,
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
