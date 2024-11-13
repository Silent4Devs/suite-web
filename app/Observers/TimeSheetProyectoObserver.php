<?php

namespace App\Observers;

use App\Events\TimesheetProyectoEvent;
use App\Models\TimeSheetProyecto;
use Illuminate\Support\Facades\Cache;

class TimeSheetProyectoObserver
{
    /**
     * Handle the TimeSheetProyecto "created" event.
     *
     * @return void
     */
    public function created(TimeSheetProyecto $timeSheetProyecto)
    {
        // event(new TimesheetProyectoEvent($timeSheetProyecto, 'createProyectos', 'timesheet_proyectos', 'Proyecto'));
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "updated" event.
     *
     * @return void
     */
    public function updated(TimeSheetProyecto $timeSheetProyecto)
    {
        // event(new TimesheetProyectoEvent($timeSheetProyecto, 'updateProyectos', 'timesheet_proyectos', 'Proyecto'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('TimesheetProyecto:timesheetproyecto_all');
        Cache::forget('TimesheetProyecto:timesheetproyecto_show_');
        Cache::forget('TimesheetProyecto:timesheetproyecto_all_order_by_identificador');
        Cache::forget('TimesheetProyecto:timesheetproyecto_all_order_by_proceso');
        Cache::forget('TimesheetProyecto:timesheetproyecto_all_with_cliente');
        Cache::forget('TimesheetProyecto:proyectos_with_tasks');
        Cache::forget('TimesheetProyecto:proyectos_dashboard');
    }
}
