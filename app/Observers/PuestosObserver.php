<?php

namespace App\Observers;

use App\Models\Puesto;
use Illuminate\Support\Facades\Cache;

class PuestosObserver
{
    /**
     * Handle the Puesto "created" event.
     *
     * @return void
     */
    public function created(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "updated" event.
     *
     * @return void
     */
    public function updated(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "deleted" event.
     *
     * @return void
     */
    public function deleted(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "restored" event.
     *
     * @return void
     */
    public function restored(Puesto $puesto)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Puesto $puesto)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Puestos_all');
        Cache::forget('Puestos:Puestos_exists');
    }
}
