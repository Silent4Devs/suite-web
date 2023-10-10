<?php

namespace App\Observers;

use App\Models\DeclaracionAplicabilidad;
use Illuminate\Support\Facades\Cache;

class DeclaracionAplicabilidadObserver
{
    /**
     * Handle the DeclaracionAplicabilidad "created" event.
     *
     * @return void
     */
    public function created(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "updated" event.
     *
     * @return void
     */
    public function updated(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "deleted" event.
     *
     * @return void
     */
    public function deleted(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "restored" event.
     *
     * @return void
     */
    public function restored(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('declaracionaplicabilidad_all');
        Cache::forget('declaracion_aplicabilidad_asc_all');
    }
}
