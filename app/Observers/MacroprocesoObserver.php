<?php

namespace App\Observers;

use App\Models\Macroproceso;
use Illuminate\Support\Facades\Cache;

class MacroprocesoObserver
{
    /**
     * Handle the Macroproceso "created" event.
     */
    public function created(Macroproceso $macroproceso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Macroproceso "updated" event.
     */
    public function updated(Macroproceso $macroproceso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Macroproceso "deleted" event.
     */
    public function deleted(Macroproceso $macroproceso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Macroproceso "restored" event.
     */
    public function restored(Macroproceso $macroproceso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Macroproceso "force deleted" event.
     */
    public function forceDeleted(Macroproceso $macroproceso): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Macroprocesos:Macroprocesos_all');
    }
}
