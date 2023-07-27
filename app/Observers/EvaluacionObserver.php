<?php

namespace App\Observers;

use App\Models\RH\Evaluacion;
use Illuminate\Support\Facades\Cache;

class EvaluacionObserver
{
    /**
     * Handle the Evaluacion "created" event.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return void
     */
    public function created(Evaluacion $evaluacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Evaluacion "updated" event.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return void
     */
    public function updated(Evaluacion $evaluacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Evaluacion "deleted" event.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return void
     */
    public function deleted(Evaluacion $evaluacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Evaluacion "restored" event.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return void
     */
    public function restored(Evaluacion $evaluacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Evaluacion "force deleted" event.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return void
     */
    public function forceDeleted(Evaluacion $evaluacion)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Evaluacion_all');
    }
}
