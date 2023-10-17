<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use Livewire\Component;

class ReportesSemanas extends Component
{
    public $horas_time;

    public function render()
    {
        $empleados = Empleado::getAll();
        $timeSheetEmpleados = collect();
        $timeSheetHorasCollection = collect();

        foreach ($empleados as $empleado) {
            $timeSheets = Timesheet::with('aprobador')->where('empleado_id', $empleado->id)->get();
            foreach ($timeSheets as $timesheet) {
                $timeSheetHoras = TimesheetHoras::getDataProyTarea()->where('timesheet_id', $timesheet->id);
                foreach ($timeSheetHoras as $horas) {
                    $sumatoria = floatval($horas->horas_lunes) + floatval($horas->horas_martes + $horas->horas_miercoles) + floatval($horas->horas_jueves) + floatval($horas->horas_viernes) + floatval($horas->horas_sabado) + floatval($horas->horas_domingo);
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
        $this->horas_time = collect();
        $this->horas_time = $timeSheetHorasCollection;
        // dd($this->horas_time);

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-semanas');
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
}
