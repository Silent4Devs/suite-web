<?php

namespace App\Observers;

use App\Events\RequisicionesEvent;
use App\Models\ContractManager\Requsicion;
use Illuminate\Support\Facades\Cache;

class RequisicionesObserver
{
    /**
     * Handle the Requsicion "created" event.
     */
    public function created(Requsicion $requsicion): void
    {
        //
        event(new RequisicionesEvent($requsicion, 'create', 'requisiciones', 'Requisicion'));
        $this->forgetCache();
    }

    /**
     * Handle the Requsicion "updated" event.
     */
    public function updated(Requsicion $requsicion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Requsicion "deleted" event.
     */
    public function deleted(Requsicion $requsicion): void
    {
        //
        event(new RequisicionesEvent($requsicion, 'delete', 'requisiciones', 'Requisicion'));
        $this->forgetCache();
    }

    /**
     * Handle the Requsicion "restored" event.
     */
    public function restored(Requsicion $requsicion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Requsicion "force deleted" event.
     */
    public function forceDeleted(Requsicion $requsicion): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget(
            'Requisiciones:all',
            'Requisiciones:archivo_false_all',
            'Requisiciones:archivo_true_all',
            'Requisiciones:ordenes_compra_false',
        );
    }
}
