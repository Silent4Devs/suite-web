<?php

namespace App\Observers;

use App\Models\Timesheet;
use Illuminate\Support\Facades\Cache;

class TimesheetObserver
{
    /**
     * Handle the Timesheet "created" event.
     *
     * @return void
     */
    public function created(Timesheet $timesheet)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Timesheet "updated" event.
     *
     * @return void
     */
    public function updated(Timesheet $timesheet)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Timesheet "deleted" event.
     *
     * @return void
     */
    public function deleted(Timesheet $timesheet)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Timesheet "restored" event.
     *
     * @return void
     */
    public function restored(Timesheet $timesheet)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Timesheet "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Timesheet $timesheet)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Timesheet:timesheet-' . auth()->user()->empleado->id);
        Cache::forget('Timesheet:timesheet_horas_all');
        Cache::forget('Timesheet:timesheet_all');
        Cache::forget('timesheet_estatus');
        Cache::forget('timesheet_reportes');
    }
}
