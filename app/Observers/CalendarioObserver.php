<?php

namespace App\Observers;

use App\Models\Calendario;
use Illuminate\Support\Facades\Cache;

class CalendarioObserver
{
    /**
     * Handle the Calendario "created" event.
     *
     * @return void
     */
    public function created(Calendario $calendario)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Calendario "updated" event.
     *
     * @return void
     */
    public function updated(Calendario $calendario)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Calendario "deleted" event.
     *
     * @return void
     */
    public function deleted(Calendario $calendario)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Calendario "restored" event.
     *
     * @return void
     */
    public function restored(Calendario $calendario)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Calendario "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Calendario $calendario)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Calendario:calendario_all');
    }
}
