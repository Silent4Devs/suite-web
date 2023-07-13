<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\DeclaracionAplicabilidad;

class DeclaracionAplicabilidadObserver
{
    /**
     * Handle the DeclaracionAplicabilidad "created" event.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return void
     */
    public function created(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "updated" event.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return void
     */
    public function updated(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "deleted" event.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return void
     */
    public function deleted(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "restored" event.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return void
     */
    public function restored(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the DeclaracionAplicabilidad "force deleted" event.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return void
     */
    public function forceDeleted(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('declaracionaplicabilidad_all');
    }
}
