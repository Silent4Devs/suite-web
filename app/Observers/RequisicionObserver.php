<?php

namespace App\Observers;

use App\Events\RequisicionEvent;
use App\Models\ContractManager\Requsicion;
use Illuminate\Support\Facades\Cache;

class RequisicionObserver
{
    /**
     * Handle the AuditoriaAnual "created" event.
     *
     * @return void
     */
    public function created(Requsicion $requisicion)
    {
        event(new RequisicionEvent($requisicion, 'create', 'requisiciones', 'Requisiciones'));
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaAnual "updated" event.
     *
     * @return void
     */
    public function updated(Requsicion $requisicion)
    {
        event(new RequisicionEvent($requisicion, 'update', 'requisiciones', 'Requisiciones'));
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaAnual "deleted" event.
     *
     * @return void
     */
    public function deleted(Requsicion $requisicion)
    {
        event(new RequisicionEvent($requisicion, 'delete', 'requisiciones', 'Requisiciones'));
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaAnual "restored" event.
     *
     * @return void
     */
    public function restored(Requsicion $requisicion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaAnual "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Requsicion $auditoriaAnual)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('AuditoriaAnual:auditoriaanual_all');
    }
}