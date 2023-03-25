<?php

namespace App\Observers;

use App\Events\RegistroMejoraEvent;
use App\Models\Registromejora;

class RegistroMejoraObserver
{
    /**
     * Handle the Registromejora "created" event.
     *
     * @param  \App\Models\Registromejora  $registromejora
     * @return void
     */
    public function created(Registromejora $registromejora)
    {
        event(new RegistroMejoraEvent($registromejora, 'create', 'registro-mejora', 'Registro de Mejora'));
    }

    /**
     * Handle the Registromejora "updated" event.
     *
     * @param  \App\Models\Registromejora  $registromejora
     * @return void
     */
    public function updated(Registromejora $registromejora)
    {
        event(new RegistroMejoraEvent($registromejora, 'update', 'registro-mejora', 'Registro de Mejora'));
    }

    /**
     * Handle the Registromejora "deleted" event.
     *
     * @param  \App\Models\Registromejora  $registromejora
     * @return void
     */
    public function deleted(Registromejora $registromejora)
    {
        event(new RegistroMejoraEvent($registromejora, 'delete', 'registro-mejora', 'Registro de Mejora'));
    }

    /**
     * Handle the Registromejora "restored" event.
     *
     * @param  \App\Models\Registromejora  $registromejora
     * @return void
     */
    public function restored(Registromejora $registromejora)
    {
        //
    }

    /**
     * Handle the Registromejora "force deleted" event.
     *
     * @param  \App\Models\Registromejora  $registromejora
     * @return void
     */
    public function forceDeleted(Registromejora $registromejora)
    {
        //
    }
}
