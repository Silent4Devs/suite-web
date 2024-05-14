<?php

namespace App\Exports\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmpleadosTimesheetExcel implements FromCollection, WithColumnWidths, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $empleados = Empleado::getAll();
        // $empleado = Empleado::find(156);
        $timeSheetEmpleados = collect();
        foreach ($empleados as $empleado) {
            $timeSheets = Timesheet::with('aprobador')->where('empleado_id', $empleado->id)->whereIn('estatus', ['aprobado', 'pendiente'])->get();
            $timeSheetHorasCollection = collect();
            foreach ($timeSheets as $timesheet) {
                $timeSheetHoras = TimesheetHoras::getDataProyTarea()->where('timesheet_id', $timesheet->id);
                foreach ($timeSheetHoras as $horas) {
                    $sumatoria = floatval($horas->horas_lunes) + floatval($horas->horas_martes) + floatval($horas->horas_miercoles) + floatval($horas->horas_jueves) + floatval($horas->horas_viernes) + floatval($horas->horas_sabado) + floatval($horas->horas_domingo);
                    $existe_proyecto = in_array($horas->proyecto_id, array_column($timeSheetHorasCollection->toArray(), 'proyecto_id'));
                    $existe_tarea = $this->existsTask($timeSheetHorasCollection, $timesheet->fecha_dia, $horas->proyecto_id, $horas->tarea_id);
                    $existe_fecha_timesheet = in_array($timesheet->fecha_dia, array_column($timeSheetHorasCollection->toArray(), 'timesheet_fin'));
                    if (! $existe_fecha_timesheet) {
                        $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                    } else {
                        if (! $existe_proyecto) {
                            $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                        } else {
                            if (! $existe_tarea) {
                                $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                            } else {
                                $timeSheetHorasCollection = $this->addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas, $timesheet);
                            }
                        }
                    }
                }
            }
            $timeSheetEmpleados->push($timeSheetHorasCollection);
        }

        return $timeSheetEmpleados->flatten(1);
    }

    public function existsTask($timeSheetHorasCollection, $fecha, $proyecto_id, $tarea_id)
    {
        foreach ($timeSheetHorasCollection as $item) {
            if ($item['timesheet_fin'] == $fecha && $item['proyecto_id'] == $proyecto_id && $item['tarea_id'] == $tarea_id) {
                return true;
            }
        }
    }

    public function pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas)
    {
        $timeSheetHorasCollection->push([
            'timesheet' => $timesheet->semana_text,
            'timesheet_fin' => $timesheet->fecha_dia,
            'empleado' => $empleado->name,
            'aprobador' => $timesheet->aprobador ? $timesheet->aprobador->name : 'Sin aprobador',
            'proyecto' => $horas->proyecto->proyecto,
            'proyecto_id' => $horas->proyecto->id,
            'tarea' => $horas->tarea->tarea,
            'tarea_descripcion' => $horas->tarea->descripcion,
            'tarea_id' => $horas->tarea->id,
            'horas' => $sumatoria,
        ]);
    }

    public function addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas, $timesheet)
    {
        $timeSheetHorasCollection = $timeSheetHorasCollection->map(function ($item) use ($horas, $sumatoria, $timesheet) {
            if (($item['proyecto_id'] == $horas->proyecto_id && $item['tarea_id'] == $horas->tarea_id && $item['timesheet_fin'] == $timesheet->fecha_dia)) {
                $item['horas'] += $sumatoria;
            }

            return $item;
        });

        return $timeSheetHorasCollection->sortBy('timesheet_fin');
    }

    public function map($timeSheetEmpleados): array
    {
        return [
            $timeSheetEmpleados['timesheet_fin'],
            $timeSheetEmpleados['empleado'],
            $timeSheetEmpleados['aprobador'],
            $timeSheetEmpleados['proyecto'],
            $timeSheetEmpleados['tarea'],
            // $timeSheetEmpleados['tarea_descripcion'],
            $timeSheetEmpleados['horas'],
            '0',
            $timeSheetEmpleados['horas'],
        ];
    }

    public function headings(): array
    {
        return [
            'Week Ending Date',
            'Employee',
            'Manager',
            'Project',
            'Task',
            // 'Task Description',
            'Billable',
            'Non Billable',
            'Total',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 45,
            'B' => 45,
            'C' => 45,
            'D' => 45,
            'E' => 45,
            'F' => 15,
            'G' => 15,
            'H' => 15,
        ];
    }
}
