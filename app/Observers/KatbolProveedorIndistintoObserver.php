<?php

namespace App\Observers;

use App\Models\ContractManager\ProveedorIndistinto;
use Illuminate\Support\Facades\Cache;

class KatbolProveedorIndistintoObserver
{
    /**
     * Handle the ProveedorIndistinto "created" event.
     */
    public function created(ProveedorIndistinto $proveedorIndistinto): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorIndistinto "updated" event.
     */
    public function updated(ProveedorIndistinto $proveedorIndistinto): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorIndistinto "deleted" event.
     */
    public function deleted(ProveedorIndistinto $proveedorIndistinto): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorIndistinto "restored" event.
     */
    public function restored(ProveedorIndistinto $proveedorIndistinto): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ProveedorIndistinto "force deleted" event.
     */
    public function forceDeleted(ProveedorIndistinto $proveedorIndistinto): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Katbol:proveedorIndistinto_first');
    }
}
