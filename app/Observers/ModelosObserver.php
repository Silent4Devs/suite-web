<?php

namespace App\Observers;

use App\Models\Modelo;
use Illuminate\Support\Facades\Cache;

class ModelosObserver
{
    /**
     * Handle the Modelo "created" event.
     *
     * @return void
     */
    public function created(Modelo $modelo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Modelo "updated" event.
     *
     * @return void
     */
    public function updated(Modelo $modelo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Modelo "deleted" event.
     *
     * @return void
     */
    public function deleted(Modelo $modelo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Modelo "restored" event.
     *
     * @return void
     */
    public function restored(Modelo $modelo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Modelo "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Modelo $modelo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Modelos_all');
        Cache::forget('Modelos_*');
    }
}
