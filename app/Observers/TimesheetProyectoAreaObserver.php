<?php

namespace App\Observers;

use App\Models\TimesheetProyectoArea;
use Illuminate\Support\Facades\Cache;

class TimesheetProyectoAreaObserver
{
    /**
     * Handle the TimesheetProyectoArea "created" event.
     */
    public function created(TimesheetProyectoArea $timesheetProyectoArea): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoArea "updated" event.
     */
    public function updated(TimesheetProyectoArea $timesheetProyectoArea): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoArea "deleted" event.
     */
    public function deleted(TimesheetProyectoArea $timesheetProyectoArea): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoArea "restored" event.
     */
    public function restored(TimesheetProyectoArea $timesheetProyectoArea): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoArea "force deleted" event.
     */
    public function forceDeleted(TimesheetProyectoArea $timesheetProyectoArea): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {

        Cache::forget('TimesheetProyectoArea:timesheet_proyecto_area_proyecto_all');
        Cache::forget('TimesheetProyectoArea:getAreaTimesheetProyectoEmpleado');
    }
}
