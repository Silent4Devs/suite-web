<?php

namespace App\Observers;

use App\Models\TimeSheetCliente;
use Illuminate\Support\Facades\Cache;

class TimeSheetClienteObserver
{
    /**
     * Handle the TimeSheetCliente "created" event.
     *
     * @return void
     */
    public function created(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "updated" event.
     *
     * @return void
     */
    public function updated(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "deleted" event.
     *
     * @return void
     */
    public function deleted(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "restored" event.
     *
     * @return void
     */
    public function restored(TimeSheetCliente $timeSheetCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetCliente "force deleted" event.
     *
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
