<?php

namespace App\Observers;

use App\Models\ContractManager\Moneda;
use Illuminate\Support\Facades\Cache;

class MonedaObserver
{
    /**
     * Handle the Moneda "created" event.
     */
    public function created(Moneda $moneda): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Moneda "updated" event.
     */
    public function updated(Moneda $moneda): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Moneda "deleted" event.
     */
    public function deleted(Moneda $moneda): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Moneda "restored" event.
     */
    public function restored(Moneda $moneda): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Moneda "force deleted" event.
     */
    public function forceDeleted(Moneda $moneda): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('Moneda:all');
    }
}
