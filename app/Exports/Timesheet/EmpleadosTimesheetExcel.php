<?php

namespace App\Exports\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmpleadosTimesheetExcel implements FromCollection, WithHeadings, WithMapping, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $empleados = Empleado::get();
        $timeSheetEmpleados = collect();
        $timeSheetHorasCollection = collect();

        foreach ($empleados as $empleado) {
            $timeSheets = Timesheet::with('aprobador')->where('empleado_id', $empleado->id)->get();
            foreach ($timeSheets as $timesheet) {
                $timeSheetHoras = TimesheetHoras::with('proyecto', 'tarea')->where('timesheet_id', $timesheet->id)->get();
                foreach ($timeSheetHoras as $horas) {
                    $sumatoria = $horas->horas_lunes + $horas->horas_martes + $horas->horas_miercoles + $horas->horas_jueves + $horas->horas_viernes + $horas->horas_sabado + $horas->horas_domingo;
                    $existe_proyecto = in_array($horas->proyecto_id, array_column($timeSheetHorasCollection->toArray(), 'proyecto_id'));
                    $existe_tarea = in_array($horas->tarea_id, array_column($timeSheetHorasCollection->toArray(), 'tarea_id'));
                    $existe_fecha_timesheet = in_array($timesheet->semana_text, array_column($timeSheetHorasCollection->toArray(), 'timesheet'));
                    if (!$existe_fecha_timesheet) {
                        if (!$existe_proyecto) {
                            if (!$existe_tarea) {
                                $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                            } else {
                                $timeSheetHorasCollection = $this->addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas);
                            }
                        } else {
                            if (!$existe_tarea) {
                                $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                            } else {
                                $timeSheetHorasCollection = $this->addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas);
                            }
                        }
                    } else {
                        if (!$existe_proyecto) {
                            if (!$existe_tarea) {
                                $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                            } else {
                                $timeSheetHorasCollection = $this->addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas);
                            }
                        } else {
                            if (!$existe_tarea) {
                                $this->pushInformationTimesheet($timeSheetHorasCollection, $empleado, $timesheet, $sumatoria, $horas);
                            } else {
                                $timeSheetHorasCollection = $this->addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas);
                            }
                        }
                    }
                }
            }
        }
        return $timeSheetHorasCollection;
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

    public function addHoursToExistentTimeSheet($timeSheetHorasCollection, $sumatoria, $horas)
    {
        $timeSheetHorasCollection = $timeSheetHorasCollection->map(function ($item) use ($horas, $sumatoria) {
            if (($item['proyecto_id'] == $horas->proyecto_id && $item['tarea_id'] == $horas->tarea_id)) {
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
            0,
            $timeSheetEmpleados['horas']
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
            'Total'
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
