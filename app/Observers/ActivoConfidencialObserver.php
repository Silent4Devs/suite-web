<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\activoConfidencialidad;

class ActivoConfidencialObserver
{
    /**
     * Handle the activoConfidencialidad "created" event.
     *
     * @param  \App\Models\activoConfidencialidad  $activoConfidencialidad
     * @return void
     */
    public function created(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "updated" event.
     *
     * @param  \App\Models\activoConfidencialidad  $activoConfidencialidad
     * @return void
     */
    public function updated(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "deleted" event.
     *
     * @param  \App\Models\activoConfidencialidad  $activoConfidencialidad
     * @return void
     */
    public function deleted(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "restored" event.
     *
     * @param  \App\Models\activoConfidencialidad  $activoConfidencialidad
     * @return void
     */
    public function restored(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "force deleted" event.
     *
     * @param  \App\Models\activoConfidencialidad  $activoConfidencialidad
     * @return void
     */
    public function forceDeleted(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('ActivosConfidencial_all');
    }
}
