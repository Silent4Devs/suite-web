<?php

namespace App\Observers;

use App\Models\TimeSheetProyecto;
use Illuminate\Support\Facades\Cache;

class TimeSheetProyectoObserver
{
    /**
     * Handle the TimeSheetProyecto "created" event.
     *
     * @param  \App\Models\TimeSheetProyecto  $timeSheetProyecto
     * @return void
     */
    public function created(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "updated" event.
     *
     * @param  \App\Models\TimeSheetProyecto  $timeSheetProyecto
     * @return void
     */
    public function updated(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "deleted" event.
     *
     * @param  \App\Models\TimeSheetProyecto  $timeSheetProyecto
     * @return void
     */
    public function deleted(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "restored" event.
     *
     * @param  \App\Models\TimeSheetProyecto  $timeSheetProyecto
     * @return void
     */
    public function restored(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetProyecto "force deleted" event.
     *
     * @param  \App\Models\TimeSheetProyecto  $timeSheetProyecto
     * @return void
     */
    public function forceDeleted(TimeSheetProyecto $timeSheetProyecto)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('timesheetproyecto_all');
    }
}
