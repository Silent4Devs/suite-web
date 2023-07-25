<?php

namespace App\Observers;

use App\Models\RH\TipoObjetivo;
use Illuminate\Support\Facades\Cache;

class tipoObjetivoObserver
{
    /**
     * Handle the TipoObjetivo "created" event.
     *
     * @param  \App\Models\TipoObjetivo  $tipoObjetivo
     * @return void
     */
    public function created(TipoObjetivo $tipoObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoObjetivo "updated" event.
     *
     * @param  \App\Models\TipoObjetivo  $tipoObjetivo
     * @return void
     */
    public function updated(TipoObjetivo $tipoObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoObjetivo "deleted" event.
     *
     * @param  \App\Models\TipoObjetivo  $tipoObjetivo
     * @return void
     */
    public function deleted(TipoObjetivo $tipoObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoObjetivo "restored" event.
     *
     * @param  \App\Models\TipoObjetivo  $tipoObjetivo
     * @return void
     */
    public function restored(TipoObjetivo $tipoObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoObjetivo "force deleted" event.
     *
     * @param  \App\Models\TipoObjetivo  $tipoObjetivo
     * @return void
     */
    public function forceDeleted(TipoObjetivo $tipoObjetivo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('TipoObjetivo_all');
    }
}
