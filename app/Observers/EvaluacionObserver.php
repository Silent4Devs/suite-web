<?php

namespace App\Observers;

use App\Events\EvaluacionEvent;
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
        event(new EvaluacionEvent($evaluacion, 'create', 'ev360_evaluaciones', 'Evaluación'));
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
        event(new EvaluacionEvent($evaluacion, 'update', 'ev360_evaluaciones', 'Evaluación'));
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
        event(new EvaluacionEvent($evaluacion, 'delete', 'ev360_evaluaciones', 'Evaluación'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Evaluacion:Evaluacion_all');
        Cache::forget('Evaluacion:Evaluacion_latest_first');
    }
}
