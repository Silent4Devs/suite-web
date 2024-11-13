<?php

namespace App\Observers;

use App\Models\EvaluacionDesempeno;
use Illuminate\Support\Facades\Cache;

class EvaluacionesDesempenoObserver
{
    /**
     * Handle the EvaluacionDesempeno "created" event.
     */
    public function created(EvaluacionDesempeno $evaluacionDesempeno): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the EvaluacionDesempeno "updated" event.
     */
    public function updated(EvaluacionDesempeno $evaluacionDesempeno): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the EvaluacionDesempeno "deleted" event.
     */
    public function deleted(EvaluacionDesempeno $evaluacionDesempeno): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the EvaluacionDesempeno "restored" event.
     */
    public function restored(EvaluacionDesempeno $evaluacionDesempeno): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the EvaluacionDesempeno "force deleted" event.
     */
    public function forceDeleted(EvaluacionDesempeno $evaluacionDesempeno): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('EvaluacionesDesempeno:evaluaciones_desempeno_all');
    }
}
