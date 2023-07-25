<?php

namespace App\Observers;

use App\Models\activoConfidencialidad;
use Illuminate\Support\Facades\Cache;

class ActivoConfidencialObserver
{
    /**
     * Handle the activoConfidencialidad "created" event.
     *
     * @return void
     */
    public function created(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "updated" event.
     *
     * @return void
     */
    public function updated(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "deleted" event.
     *
     * @return void
     */
    public function deleted(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "restored" event.
     *
     * @return void
     */
    public function restored(activoConfidencialidad $activoConfidencialidad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the activoConfidencialidad "force deleted" event.
     *
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
