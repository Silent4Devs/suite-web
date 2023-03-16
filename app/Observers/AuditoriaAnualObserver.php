<?php

namespace App\Observers;

use App\Events\AuditoriaAnualEvent;
use App\Models\AuditoriaAnual;

class AuditoriaAnualObserver
{
    /**
     * Handle the AuditoriaAnual "created" event.
     *
     * @param  \App\Models\AuditoriaAnual  $auditoriaAnual
     * @return void
     */
    public function created(AuditoriaAnual $auditoriaAnual)
    {
        event(new AuditoriaAnualEvent($auditoriaAnual, 'create', 'auditoria-anual', 'Auditoria Anual'));
    }

    /**
     * Handle the AuditoriaAnual "updated" event.
     *
     * @param  \App\Models\AuditoriaAnual  $auditoriaAnual
     * @return void
     */
    public function updated(AuditoriaAnual $auditoriaAnual)
    {
        event(new AuditoriaAnualEvent($auditoriaAnual, 'update', 'auditoria-anual', 'Auditoria Anual'));
    }

    /**
     * Handle the AuditoriaAnual "deleted" event.
     *
     * @param  \App\Models\AuditoriaAnual  $auditoriaAnual
     * @return void
     */
    public function deleted(AuditoriaAnual $auditoriaAnual)
    {
        event(new AuditoriaAnualEvent($auditoriaAnual, 'delete', 'auditoria-anual', 'Auditoria Anual'));
    }

    /**
     * Handle the AuditoriaAnual "restored" event.
     *
     * @param  \App\Models\AuditoriaAnual  $auditoriaAnual
     * @return void
     */
    public function restored(AuditoriaAnual $auditoriaAnual)
    {
        //
    }

    /**
     * Handle the AuditoriaAnual "force deleted" event.
     *
     * @param  \App\Models\AuditoriaAnual  $auditoriaAnual
     * @return void
     */
    public function forceDeleted(AuditoriaAnual $auditoriaAnual)
    {
        //
    }
}
