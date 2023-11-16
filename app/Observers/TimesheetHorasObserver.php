<?php

namespace App\Observers;

use App\Models\TimesheetHoras;
use Illuminate\Support\Facades\Cache;

class TimesheetHorasObserver
{
    /**
     * Handle the TimesheetHoras "created" event.
     */
    public function created(TimesheetHoras $timesheetHoras): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetHoras "updated" event.
     */
    public function updated(TimesheetHoras $timesheetHoras): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetHoras "deleted" event.
     */
    public function deleted(TimesheetHoras $timesheetHoras): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetHoras "restored" event.
     */
    public function restored(TimesheetHoras $timesheetHoras): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetHoras "force deleted" event.
     */
    public function forceDeleted(TimesheetHoras $timesheetHoras): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('TimesheetHoras:timesheethoras_index');
        Cache::forget('TimesheetHoras:timesheethoras_all');
        Cache::forget('TimesheetHoras:timesheet_data_all');
        Cache::forget('TimesheetHoras:timesheet_data_proy_tarea');
        Cache::forget('TimesheetHoras:timesheet_reporte_colaborador_tareas');
    }
}
