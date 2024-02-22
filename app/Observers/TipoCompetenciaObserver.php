<?php

namespace App\Observers;

use App\Models\RH\TipoCompetencia;
use Illuminate\Support\Facades\Cache;

class TipoCompetenciaObserver
{
    /**
     * Handle the TipoCompetencia "created" event.
     *
     * @param  \App\Models\TipoCompetencia  $tipoCompetencia
     * @return void
     */
    public function created(TipoCompetencia $tipoCompetencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoCompetencia "updated" event.
     *
     * @param  \App\Models\TipoCompetencia  $tipoCompetencia
     * @return void
     */
    public function updated(TipoCompetencia $tipoCompetencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoCompetencia "deleted" event.
     *
     * @param  \App\Models\TipoCompetencia  $tipoCompetencia
     * @return void
     */
    public function deleted(TipoCompetencia $tipoCompetencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoCompetencia "restored" event.
     *
     * @param  \App\Models\TipoCompetencia  $tipoCompetencia
     * @return void
     */
    public function restored(TipoCompetencia $tipoCompetencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoCompetencia "force deleted" event.
     *
     * @param  \App\Models\TipoCompetencia  $tipoCompetencia
     * @return void
     */
    public function forceDeleted(TipoCompetencia $tipoCompetencia)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('TipoCompetencia:Tipocompetencias_all');
    }
}
