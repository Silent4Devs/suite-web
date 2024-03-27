<?php

namespace App\Observers;

use App\Models\ContractManager\Sucursal;
use Illuminate\Support\Facades\Cache;

class SucursalObserver
{
    /**
     * Handle the Sucursal "created" event.
     */
    public function created(Sucursal $sucursal): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sucursal "updated" event.
     */
    public function updated(Sucursal $sucursal): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sucursal "deleted" event.
     */
    public function deleted(Sucursal $sucursal): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sucursal "restored" event.
     */
    public function restored(Sucursal $sucursal): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Sucursal "force deleted" event.
     */
    public function forceDeleted(Sucursal $sucursal): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Sucursales:Sucursales_al');
        Cache::forget('Sucursales:Sucursales_archivo_false');
        Cache::forget('Sucursales:Sucursales_archivo_true');
        Cache::forget('Sucursales:Sucursales_pluck_id');
    }
}
