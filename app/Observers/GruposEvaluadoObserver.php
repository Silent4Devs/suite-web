<?php

namespace App\Observers;

use App\Models\RH\GruposEvaluado;
use Illuminate\Support\Facades\Cache;

class GruposEvaluadoObserver
{
    /**
     * Handle the GruposEvaluado "created" event.
     */
    public function created(GruposEvaluado $gruposEvaluado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the GruposEvaluado "updated" event.
     */
    public function updated(GruposEvaluado $gruposEvaluado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the GruposEvaluado "deleted" event.
     */
    public function deleted(GruposEvaluado $gruposEvaluado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the GruposEvaluado "restored" event.
     */
    public function restored(GruposEvaluado $gruposEvaluado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the GruposEvaluado "force deleted" event.
     */
    public function forceDeleted(GruposEvaluado $gruposEvaluado): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('GruposEvaluado:gruposevaluado_all');
        Cache::forget('GruposEvaluado:gruposevaluado_with_empleado');
    }
}
