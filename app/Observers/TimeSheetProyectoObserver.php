<?php

namespace App\Observers;

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
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "updated" event.
     *
     * @return void
     */
    public function updated(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "deleted" event.
     *
     * @return void
     */
    public function deleted(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "restored" event.
     *
     * @return void
     */
    public function restored(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(TimeSheetProyecto $timeSheetProyecto)
    {
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
    }
}
