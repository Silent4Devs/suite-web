<?php

namespace App\Observers;

use App\Models\Puesto;
use Illuminate\Support\Facades\Cache;

class PuestosObserver
{
    /**
     * Handle the Puesto "created" event.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return void
     */
    public function created(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "updated" event.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return void
     */
    public function updated(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "deleted" event.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return void
     */
    public function deleted(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "restored" event.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return void
     */
    public function restored(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "force deleted" event.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return void
     */
    public function forceDeleted(Puesto $puesto)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Puestos_all');
    }
}
