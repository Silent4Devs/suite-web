<?php

namespace App\Observers;

use App\Models\ContractManager\Comprador;
use Illuminate\Support\Facades\Cache;

class CompradorObserver
{
    /**
     * Handle the Comprador "created" event.
     */
    public function created(Comprador $comprador): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Comprador "updated" event.
     */
    public function updated(Comprador $comprador): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Comprador "deleted" event.
     */
    public function deleted(Comprador $comprador): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Comprador "restored" event.
     */
    public function restored(Comprador $comprador): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Comprador "force deleted" event.
     */
    public function forceDeleted(Comprador $comprador): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('Comprador:Comprador_all');
        Cache::forget('Comprador:Comprador_archivo_false');
        Cache::forget('Comprador:Comprador_archivo_true');
    }
}
