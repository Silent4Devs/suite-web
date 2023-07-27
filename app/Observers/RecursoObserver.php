<?php

namespace App\Observers;

use App\Models\Recurso;
use Illuminate\Support\Facades\Cache;

class RecursoObserver
{
    /**
     * Handle the Recurso "created" event.
     *
     * @return void
     */
    public function created(Recurso $recurso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Recurso "updated" event.
     *
     * @return void
     */
    public function updated(Recurso $recurso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Recurso "deleted" event.
     *
     * @return void
     */
    public function deleted(Recurso $recurso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Recurso "restored" event.
     *
     * @return void
     */
    public function restored(Recurso $recurso)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Recurso "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Recurso $recurso)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('recursos_all');
    }
}
