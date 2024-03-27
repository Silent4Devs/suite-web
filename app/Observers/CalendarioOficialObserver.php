<?php

namespace App\Observers;

use App\Models\CalendarioOficial;
use Illuminate\Support\Facades\Cache;

class CalendarioOficialObserver
{
    /**
     * Handle the CalendarioOficial "created" event.
     */
    public function created(CalendarioOficial $calendarioOficial): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CalendarioOficial "updated" event.
     */
    public function updated(CalendarioOficial $calendarioOficial): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CalendarioOficial "deleted" event.
     */
    public function deleted(CalendarioOficial $calendarioOficial): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CalendarioOficial "restored" event.
     */
    public function restored(CalendarioOficial $calendarioOficial): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CalendarioOficial "force deleted" event.
     */
    public function forceDeleted(CalendarioOficial $calendarioOficial): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Calendario:calendario_oficial_all');
    }
}
