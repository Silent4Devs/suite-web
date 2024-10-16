<?php

namespace App\Observers;

use App\Events\TimesheetEvent;
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
        try {
            // event(new TimesheetEvent($timesheet, 'create', 'timesheet', 'Timesheet'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $this->forgetCache();
    }

    /**
     * Handle the Timesheet "updated" event.
     *
     * @return void
     */
    public function updated(Timesheet $timesheet)
    {
        try {
            // event(new TimesheetEvent($timesheet, 'update', 'timesheet', 'Timesheet'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $this->forgetCache();
    }

    /**
     * Handle the Timesheet "deleted" event.
     *
     * @return void
     */
    public function deleted(Timesheet $timesheet)
    {
        try {
            // event(new TimesheetEvent($timesheet, 'delete', 'timesheet', 'Timesheet'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Timesheet:timesheet-'.auth()->user()->empleado->id);
        Cache::forget('Timesheet:timesheet_horas_all');
        Cache::forget('Timesheet:timesheet_all');
        Cache::forget('Timesheet:timesheet_estatus');
        Cache::forget('Timesheet:timesheet_reportes');
    }
}
