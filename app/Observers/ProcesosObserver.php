<?php

namespace App\Observers;

use App\Models\Proceso;
use Illuminate\Support\Facades\Cache;

class ProcesosObserver
{
    /**
     * Handle the Proceso "created" event.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return void
     */
    public function created(Proceso $proceso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Proceso "updated" event.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return void
     */
    public function updated(Proceso $proceso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Proceso "deleted" event.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return void
     */
    public function deleted(Proceso $proceso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Proceso "restored" event.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return void
     */
    public function restored(Proceso $proceso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Proceso "force deleted" event.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return void
     */
    public function forceDeleted(Proceso $proceso)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('activos_all');
    }
}
