<?php

namespace App\Observers;

use App\Models\RH\Competencia;
use Illuminate\Support\Facades\Cache;

class CompetenciaObserver
{
    /**
     * Handle the Competencia "created" event.
     *
     * @param  \App\Models\Competencia  $competencia
     * @return void
     */
    public function created(Competencia $competencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Competencia "updated" event.
     *
     * @param  \App\Models\Competencia  $competencia
     * @return void
     */
    public function updated(Competencia $competencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Competencia "deleted" event.
     *
     * @param  \App\Models\Competencia  $competencia
     * @return void
     */
    public function deleted(Competencia $competencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Competencia "restored" event.
     *
     * @param  \App\Models\Competencia  $competencia
     * @return void
     */
    public function restored(Competencia $competencia)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Competencia "force deleted" event.
     *
     * @param  \App\Models\Competencia  $competencia
     * @return void
     */
    public function forceDeleted(Competencia $competencia)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Competencias:Competencias_all');
        Cache::forget('Competencias:Competencias_with_tipo');
    }
}
