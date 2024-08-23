<?php

namespace App\Observers;

use App\Events\RiesgosEvent;
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
        event(new RiesgosEvent($riesgoIdentificado, 'create', 'riesgos_identificados', 'Riesgo'));

        $this->forgetCache();
    }

    /**
     * Handle the RiesgoIdentificado "updated" event.
     *
     * @return void
     */
    public function updated(RiesgoIdentificado $riesgoIdentificado)
    {
        event(new RiesgosEvent($riesgoIdentificado, 'update', 'riesgos_identificados', 'Riesgo'));

        $this->forgetCache();
    }

    /**
     * Handle the RiesgoIdentificado "deleted" event.
     *
     * @return void
     */
    public function deleted(RiesgoIdentificado $riesgoIdentificado)
    {
        event(new RiesgosEvent($riesgoIdentificado, 'delete', 'riesgos_identificados', 'Riesgo'));

        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('riesgo_identificado_all');
    }
}
