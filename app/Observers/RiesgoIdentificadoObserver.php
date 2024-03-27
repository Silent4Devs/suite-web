<?php

namespace App\Observers;

use App\Models\RiesgoIdentificado;
use Illuminate\Support\Facades\Cache;

class RiesgoIdentificadoObserver
{
    /**
     * Handle the RiesgoIdentificado "created" event.
     *
     * @return void
     */
    public function created(RiesgoIdentificado $riesgoIdentificado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the RiesgoIdentificado "updated" event.
     *
     * @return void
     */
    public function updated(RiesgoIdentificado $riesgoIdentificado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the RiesgoIdentificado "deleted" event.
     *
     * @return void
     */
    public function deleted(RiesgoIdentificado $riesgoIdentificado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the RiesgoIdentificado "restored" event.
     *
     * @return void
     */
    public function restored(RiesgoIdentificado $riesgoIdentificado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the RiesgoIdentificado "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(RiesgoIdentificado $riesgoIdentificado)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('riesgo_identificado_all');
    }
}
