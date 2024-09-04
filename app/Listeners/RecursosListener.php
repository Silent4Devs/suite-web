<?php

namespace App\Listeners;

use App\Notifications\RecursosNotification;
use Illuminate\Support\Facades\Notification;

class RecursosListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $participantes = $event->recurso->participantes;
        foreach ($participantes as $participante) {
            Notification::send($participante, new RecursosNotification($event->recurso, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}
