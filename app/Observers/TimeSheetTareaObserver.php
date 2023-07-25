<?php

namespace App\Observers;

use App\Models\TimeSheetTarea;
use Illuminate\Support\Facades\Cache;

class TimeSheetTareaObserver
{
    /**
     * Handle the TimeSheetTarea "created" event.
     *
     * @return void
     */
    public function created(TimeSheetTarea $timeSheetTarea)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetTarea "updated" event.
     *
     * @return void
     */
    public function updated(TimeSheetTarea $timeSheetTarea)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetTarea "deleted" event.
     *
     * @return void
     */
    public function deleted(TimeSheetTarea $timeSheetTarea)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetTarea "restored" event.
     *
     * @return void
     */
    public function restored(TimeSheetTarea $timeSheetTarea)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TimeSheetTarea "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(TimeSheetTarea $timeSheetTarea)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('timesheettarea_all');
    }
}
