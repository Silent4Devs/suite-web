<?php

namespace App\Observers;

use App\Models\ContractManager\CentroCosto;
use Illuminate\Support\Facades\Cache;

class CentroCostoObserver
{
    /**
     * Handle the CentroCosto "created" event.
     */
    public function created(CentroCosto $centroCosto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CentroCosto "updated" event.
     */
    public function updated(CentroCosto $centroCosto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CentroCosto "deleted" event.
     */
    public function deleted(CentroCosto $centroCosto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CentroCosto "restored" event.
     */
    public function restored(CentroCosto $centroCosto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CentroCosto "force deleted" event.
     */
    public function forceDeleted(CentroCosto $centroCosto): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('CentroCosto:all');
    }
}
