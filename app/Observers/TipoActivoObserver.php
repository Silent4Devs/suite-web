<?php

namespace App\Observers;

use App\Models\Tipoactivo;
use Illuminate\Support\Facades\Cache;

class TipoActivoObserver
{
    /**
     * Handle the Tipoactivo "created" event.
     *
     * @return void
     */
    public function created(Tipoactivo $tipoactivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Tipoactivo "updated" event.
     *
     * @return void
     */
    public function updated(Tipoactivo $tipoactivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Tipoactivo "deleted" event.
     *
     * @return void
     */
    public function deleted(Tipoactivo $tipoactivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Tipoactivo "restored" event.
     *
     * @return void
     */
    public function restored(Tipoactivo $tipoactivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Tipoactivo "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Tipoactivo $tipoactivo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('tipoactivos_all');
    }
}
