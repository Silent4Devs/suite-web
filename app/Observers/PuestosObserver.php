<?php

namespace App\Observers;

use App\Events\PuestosEvent;
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
        event(new PuestosEvent($puesto, 'create', 'puestos', 'Puestos'));
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "updated" event.
     *
     * @return void
     */
    public function updated(Puesto $puesto)
    {
        event(new PuestosEvent($puesto, 'update', 'puestos', 'Puestos'));
        $this->forgetCache();
    }

    /**
     * Handle the Puesto "deleted" event.
     *
     * @return void
     */
    public function deleted(Puesto $puesto)
    {
        event(new PuestosEvent($puesto, 'delete', 'puestos', 'Puestos'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Puestos:Puestos_all');
        Cache::forget('Puestos:Puestos_exists');
    }
}
