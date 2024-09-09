<?php

namespace App\Observers;

use App\Models\Escuela\Evaluation;
use Illuminate\Support\Facades\Cache;

class EvaluationObserver
{
    /**
     * Handle the Evaluation "created" event.
     */
    public function created(Evaluation $evaluation): void
    {
        $this->forgetCache();
        //
    }

    /**
     * Handle the Evaluation "updated" event.
     */
    public function updated(Evaluation $evaluation): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Evaluation "deleted" event.
     */
    public function deleted(Evaluation $evaluation): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Evaluation "restored" event.
     */
    public function restored(Evaluation $evaluation): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Evaluation "force deleted" event.
     */
    public function forceDeleted(Evaluation $evaluation): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Evaluations:evaluations_all');
    }
}
