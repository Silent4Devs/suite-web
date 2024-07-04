<?php

namespace App\Observers;

use App\Models\ContractManager\ProveedorOC;
use Illuminate\Support\Facades\Cache;

class ProveedorOCObserver
{
    /**
     * Handle the ProveedorOC "created" event.
     */
    public function created(ProveedorOC $proveedorOC): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorOC "updated" event.
     */
    public function updated(ProveedorOC $proveedorOC): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorOC "deleted" event.
     */
    public function deleted(ProveedorOC $proveedorOC): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorOC "restored" event.
     */
    public function restored(ProveedorOC $proveedorOC): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorOC "force deleted" event.
     */
    public function forceDeleted(ProveedorOC $proveedorOC): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('ProveedorOC:ProveedorOC_all');
    }
}
