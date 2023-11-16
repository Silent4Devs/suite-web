<?php

namespace App\Exports;

use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteColaboradorRegistro implements FromCollection, WithHeadings
{
    public $fecha_inicio;

    public $fecha_fin;

    public $area_id;

    public $emp_id;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(?string $fecha_inicio, ?string $fecha_fin, ?string $area_id, ?string $emp_id)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->area_id = $area_id;
        $this->emp_id = $emp_id;
    }


    public function collection()
    {
        $query = Timesheet::leftJoin('empleados as empleados', 'empleados.id', '=', 'timesheet.empleado_id')
            ->leftJoin('empleados as aprobadores', 'aprobadores.id', '=', 'timesheet.aprobador_id')
            ->leftJoin('areas', 'empleados.area_id', '=', 'areas.id')
            ->leftJoin('timesheet_horas', 'timesheet.id', '=', 'timesheet_horas.id')
            ->leftJoin('timesheet_proyectos', 'timesheet_horas.proyecto_id', '=', 'timesheet_proyectos.id')
            ->select(
                'timesheet.id',
                'fecha_dia',
                'empleados.name as empleado_name',
                'areas.area as empleado_area',
                'aprobadores.name as supervisor_name',
                'timesheet_horas.horas_lunes',
                'timesheet_horas.horas_martes',
                'timesheet_horas.horas_miercoles',
                'timesheet_horas.horas_jueves',
                'timesheet_horas.horas_viernes',
                'timesheet_horas.horas_sabado',
                'timesheet_horas.horas_domingo',
                'timesheet_proyectos.estatus'
            )
            ->where(function ($query) {

                if ($this->fecha_inicio || $this->fecha_fin) {
                    $query->where('fecha_dia', '>=', $this->fecha_inicio ?? '1900-01-01')
                        ->where('fecha_dia', '<=', $this->fecha_fin ?? now()->format('Y-m-d'));
                }

                if ($this->emp_id != 0) {
                    $query->where('empleados.id', $this->emp_id);
                }

                if ($this->area_id != 0) {
                    $query->where('empleados.area_id', $this->area_id);
                }
            })->where('timesheet_proyectos.estatus', '!=', 'papelera')
            ->groupBy(
                'timesheet.id',
                'fecha_dia',
                'empleado_name',
                'empleado_area',
                'supervisor_name',
                'timesheet_horas.horas_lunes',
                'timesheet_horas.horas_martes',
                'timesheet_horas.horas_miercoles',
                'timesheet_horas.horas_jueves',
                'timesheet_horas.horas_viernes',
                'timesheet_horas.horas_sabado',
                'timesheet_horas.horas_domingo',
                'timesheet_proyectos.estatus'
            )->orderBy('fecha_dia', 'asc')
            ->distinct()
            ->get()
            ->map(function ($timesheet) {
                $total_horas = 0;
                $horas_time = TimesheetHoras::where('timesheet_id', $timesheet->id)->get();
                foreach ($horas_time as $key => $horas) {
                    $total_horas += floatval($horas->horas_lunes);
                    $total_horas += floatval($horas->horas_martes);
                    $total_horas += floatval($horas->horas_miercoles);
                    $total_horas += floatval($horas->horas_jueves);
                    $total_horas += floatval($horas->horas_viernes);
                    $total_horas += floatval($horas->horas_sabado);
                    $total_horas += floatval($horas->horas_domingo);
                }
                return [
                    'Fecha Inicio Proyecto' => \Carbon\Carbon::parse($timesheet->fecha_dia)->format('d/m/Y'),
                    'Empleado' => $timesheet->empleado_name,
                    'Supervisor' => $timesheet->supervisor_name,
                    'Area' => $timesheet->empleado_area,
                    'Estatus Proyecto' => $timesheet->estatus,
                    'Total de Horas' =>  $total_horas,
                ];
            });

        return $query;
    }

    public function headings(): array
    {
        return [
            'Fecha Inicio Proyecto',
            'Empleado',
            'Supervisor',
            'Area',
            'Estatus Proyecto',
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
