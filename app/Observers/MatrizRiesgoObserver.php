<?php

namespace App\Observers;

use App\Models\MatrizRiesgo;
use Illuminate\Support\Facades\Cache;

class MatrizRiesgoObserver
{
    /**
     * Handle the MatrizRiesgo "created" event.
     *
     * @param  \App\Models\MatrizRiesgo  $matrizRiesgo
     * @return void
     */
    public function created(MatrizRiesgo $matrizRiesgo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgo "updated" event.
     *
     * @param  \App\Models\MatrizRiesgo  $matrizRiesgo
     * @return void
     */
    public function updated(MatrizRiesgo $matrizRiesgo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgo "deleted" event.
     *
     * @param  \App\Models\MatrizRiesgo  $matrizRiesgo
     * @return void
     */
    public function deleted(MatrizRiesgo $matrizRiesgo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgo "restored" event.
     *
     * @param  \App\Models\MatrizRiesgo  $matrizRiesgo
     * @return void
     */
    public function restored(MatrizRiesgo $matrizRiesgo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgo "force deleted" event.
     *
     * @param  \App\Models\MatrizRiesgo  $matrizRiesgo
     * @return void
     */
    public function forceDeleted(MatrizRiesgo $matrizRiesgo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('matriz_riesgos_alll');
    }
}
