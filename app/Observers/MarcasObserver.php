<?php

namespace App\Observers;

use App\Models\Marca;
use Illuminate\Support\Facades\Cache;

class MarcasObserver
{
    /**
     * Handle the Marca "created" event.
     *
     * @param  \App\Models\Marca  $marca
     * @return void
     */
    public function created(Marca $marca)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Marca "updated" event.
     *
     * @param  \App\Models\Marca  $marca
     * @return void
     */
    public function updated(Marca $marca)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Marca "deleted" event.
     *
     * @param  \App\Models\Marca  $marca
     * @return void
     */
    public function deleted(Marca $marca)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Marca "restored" event.
     *
     * @param  \App\Models\Marca  $marca
     * @return void
     */
    public function restored(Marca $marca)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Marca "force deleted" event.
     *
     * @param  \App\Models\Marca  $marca
     * @return void
     */
    public function forceDeleted(Marca $marca)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Marcas_all');
    }
}
