<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\MatrizRiesgosSistemaGestion;

class MatrizRiesgosSistemaGestionObserver
{
    /**
     * Handle the MatrizRiesgosSistemaGestion "created" event.
     *
     * @param  \App\Models\MatrizRiesgosSistemaGestion  $matrizRiesgosSistemaGestion
     * @return void
     */
    public function created(MatrizRiesgosSistemaGestion $matrizRiesgosSistemaGestion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgosSistemaGestion "updated" event.
     *
     * @param  \App\Models\MatrizRiesgosSistemaGestion  $matrizRiesgosSistemaGestion
     * @return void
     */
    public function updated(MatrizRiesgosSistemaGestion $matrizRiesgosSistemaGestion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgosSistemaGestion "deleted" event.
     *
     * @param  \App\Models\MatrizRiesgosSistemaGestion  $matrizRiesgosSistemaGestion
     * @return void
     */
    public function deleted(MatrizRiesgosSistemaGestion $matrizRiesgosSistemaGestion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgosSistemaGestion "restored" event.
     *
     * @param  \App\Models\MatrizRiesgosSistemaGestion  $matrizRiesgosSistemaGestion
     * @return void
     */
    public function restored(MatrizRiesgosSistemaGestion $matrizRiesgosSistemaGestion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MatrizRiesgosSistemaGestion "force deleted" event.
     *
     * @param  \App\Models\MatrizRiesgosSistemaGestion  $matrizRiesgosSistemaGestion
     * @return void
     */
    public function forceDeleted(MatrizRiesgosSistemaGestion $matrizRiesgosSistemaGestion)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('matriz_riesgos_sistema_gestion_all');
        Cache::forget('matriz_riesgos_sistema_gestion_' . Auth::user()->id);
    }
}
