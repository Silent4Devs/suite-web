<?php

namespace App\Observers;

use App\Events\MinutasEvent;
use App\Models\Minutasaltadireccion;
use Illuminate\Support\Facades\Cache;

class MinutasAltaDireccionObserver
{
    /**
     * Handle the Minutasaltadireccion "created" event.
     */
    public function created(Minutasaltadireccion $minutasaltadireccion): void
    {
        event(new MinutasEvent($minutasaltadireccion, 'create', 'minutasaltadireccions', 'Minuta'));
        $this->forgetCache();
    }

    /**
     * Handle the Minutasaltadireccion "updated" event.
     */
    public function updated(Minutasaltadireccion $minutasaltadireccion): void
    {
        event(new MinutasEvent($minutasaltadireccion, 'update', 'minutasaltadireccions', 'Minuta'));
        $this->forgetCache();
    }

    /**
     * Handle the Minutasaltadireccion "deleted" event.
     */
    public function deleted(Minutasaltadireccion $minutasaltadireccion): void
    {
        event(new MinutasEvent($minutasaltadireccion, 'delete', 'minutasaltadireccions', 'Minuta'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('MinutasAltaDireccion:minutas_alta_direccion_all');
    }
}
