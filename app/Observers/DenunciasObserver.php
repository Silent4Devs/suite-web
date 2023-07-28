<?php

namespace App\Observers;

use App\Models\Denuncias;
use Illuminate\Support\Facades\Cache;

class DenunciasObserver
{
    /**
     * Handle the Denuncias "created" event.
     *
     * @param  \App\Models\Denuncias  $denuncias
     * @return void
     */
    public function created(Denuncias $denuncias)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Denuncias "updated" event.
     *
     * @param  \App\Models\Denuncias  $denuncias
     * @return void
     */
    public function updated(Denuncias $denuncias)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Denuncias "deleted" event.
     *
     * @param  \App\Models\Denuncias  $denuncias
     * @return void
     */
    public function deleted(Denuncias $denuncias)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Denuncias "restored" event.
     *
     * @param  \App\Models\Denuncias  $denuncias
     * @return void
     */
    public function restored(Denuncias $denuncias)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Denuncias "force deleted" event.
     *
     * @param  \App\Models\Denuncias  $denuncias
     * @return void
     */
    public function forceDeleted(Denuncias $denuncias)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('denuncias_all');
    }
}
