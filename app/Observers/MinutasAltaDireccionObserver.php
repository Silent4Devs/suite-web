<?php

namespace App\Observers;

use App\Models\Minutasaltadireccion;
use Illuminate\Support\Facades\Cache;

class MinutasAltaDireccionObserver
{
    /**
     * Handle the Minutasaltadireccion "created" event.
     */
    public function created(Minutasaltadireccion $minutasaltadireccion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Minutasaltadireccion "updated" event.
     */
    public function updated(Minutasaltadireccion $minutasaltadireccion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Minutasaltadireccion "deleted" event.
     */
    public function deleted(Minutasaltadireccion $minutasaltadireccion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Minutasaltadireccion "restored" event.
     */
    public function restored(Minutasaltadireccion $minutasaltadireccion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Minutasaltadireccion "force deleted" event.
     */
    public function forceDeleted(Minutasaltadireccion $minutasaltadireccion): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('MinutasAltaDireccion:minutas_alta_direccion_all');
    }
}
