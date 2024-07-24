<?php

namespace App\Observers;

use App\Events\RequisicionesEvent;
use App\Models\ContractManager\Requsicion;

class RequisicionesObserver
{
    /**
     * Handle the requisiciones "created" event.
     *
     * @return void
     */
    public function created(Requsicion $requisiciones)
    {
        event(new RequisicionesEvent($requisiciones, 'create', 'requisiciones', 'Requisiciones'));
    }

    /**
     * Handle the requisiciones "deleted" event.
     *
     * @return void
     */
    public function deleted(Requsicion $requisiciones)
    {
        event(new RequisicionesEvent($requisiciones, 'delete', 'requisiciones', 'Requisiciones'));
    }
}