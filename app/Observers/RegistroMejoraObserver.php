<?php

namespace App\Observers;

use App\Events\RegistroMejoraEvent;
use App\Models\Registromejora;
use Illuminate\Support\Facades\Queue;

class RegistroMejoraObserver
{
    /**
     * Handle the Registromejora "created" event.
     *
     * @return void
     */
    public function created(Registromejora $registromejora)
    {
        Queue::push(function () use ($registromejora) {
            event(new RegistroMejoraEvent($registromejora, 'create', 'registro-mejora', 'Registro de Mejora'));
        });

    }

    /**
     * Handle the Registromejora "updated" event.
     *
     * @return void
     */
    public function updated(Registromejora $registromejora)
    {
        Queue::push(function () use ($registromejora) {
            event(new RegistroMejoraEvent($registromejora, 'update', 'registro-mejora', 'Registro de Mejora'));
        });

    }

    /**
     * Handle the Registromejora "deleted" event.
     *
     * @return void
     */
    public function deleted(Registromejora $registromejora)
    {
        Queue::push(function () use ($registromejora) {
            event(new RegistroMejoraEvent($registromejora, 'delete', 'registro-mejora', 'Registro de Mejora'));
        });

    }

    /**
     * Handle the Registromejora "restored" event.
     *
     * @return void
     */
    public function restored(Registromejora $registromejora)
    {
        //
    }

    /**
     * Handle the Registromejora "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Registromejora $registromejora)
    {
        //
    }
}
