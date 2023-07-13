<?php

namespace App\Observers;

use App\Models\Activo;
use Illuminate\Support\Facades\Cache;

class ActivosObserver
{
    /**
     * Handle the Activo "created" event.
     *
     * @param  \App\Models\Activo  $activo
     * @return void
     */
    public function created(Activo $activo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Activo "updated" event.
     *
     * @param  \App\Models\Activo  $activo
     * @return void
     */
    public function updated(Activo $activo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Activo "deleted" event.
     *
     * @param  \App\Models\Activo  $activo
     * @return void
     */
    public function deleted(Activo $activo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Activo "restored" event.
     *
     * @param  \App\Models\Activo  $activo
     * @return void
     */
    public function restored(Activo $activo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Activo "force deleted" event.
     *
     * @param  \App\Models\Activo  $activo
     * @return void
     */
    public function forceDeleted(Activo $activo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('procesos_all');
    }
}
