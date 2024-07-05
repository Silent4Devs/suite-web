<?php

namespace App\Listeners;

use App\Notifications\RecursosNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class RecursosListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 5;

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
