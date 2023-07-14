<?php

namespace App\Observers;

use App\Models\TimeSheetCliente;
use Illuminate\Support\Facades\Cache;

class TimeSheetClienteObserver
{
    /**
     * Handle the TimeSheetCliente "created" event.
     *
     * @param  \App\Models\TimeSheetCliente  $timeSheetCliente
     * @return void
     */
    public function created(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "updated" event.
     *
     * @param  \App\Models\TimeSheetCliente  $timeSheetCliente
     * @return void
     */
    public function updated(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "deleted" event.
     *
     * @param  \App\Models\TimeSheetCliente  $timeSheetCliente
     * @return void
     */
    public function deleted(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "restored" event.
     *
     * @param  \App\Models\TimeSheetCliente  $timeSheetCliente
     * @return void
     */
    public function restored(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "force deleted" event.
     *
     * @param  \App\Models\TimeSheetCliente  $timeSheetCliente
     * @return void
     */
    public function forceDeleted(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('timesheetcliente_all');
    }
}
