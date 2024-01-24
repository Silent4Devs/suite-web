<?php

namespace App\Observers;

use App\Models\Sede;
use Illuminate\Support\Facades\Cache;

class SedesObserver
{
    /**
     * Handle the Sede "created" event.
     *
     * @return void
     */
    public function created(Sede $sede)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sede "updated" event.
     *
     * @return void
     */
    public function updated(Sede $sede)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sede "deleted" event.
     *
     * @return void
     */
    public function deleted(Sede $sede)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sede "restored" event.
     *
     * @return void
     */
    public function restored(Sede $sede)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sede "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Sede $sede)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Sede:sedes_all');
    }
}
