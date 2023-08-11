<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\TimesheetProyectoEmpleado;

class TimesheetProyectoEmpleadoObserver
{
    /**
     * Handle the TimesheetProyectoEmpleado "created" event.
     */
    public function created(TimesheetProyectoEmpleado $timesheetProyectoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoEmpleado "updated" event.
     */
    public function updated(TimesheetProyectoEmpleado $timesheetProyectoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoEmpleado "deleted" event.
     */
    public function deleted(TimesheetProyectoEmpleado $timesheetProyectoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoEmpleado "restored" event.
     */
    public function restored(TimesheetProyectoEmpleado $timesheetProyectoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimesheetProyectoEmpleado "force deleted" event.
     */
    public function forceDeleted(TimesheetProyectoEmpleado $timesheetProyectoEmpleado): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('getAllByEmpleadoId_' . auth()->user()->empleado->id);
        Cache::forget('getAllByEmpleadoIdExists_' . auth()->user()->empleado->id);
    }
}
