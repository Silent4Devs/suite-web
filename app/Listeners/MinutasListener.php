<?php

namespace App\Listeners;

use App\Models\Minutasaltadireccion;
use App\Models\User;
use App\Notifications\MinutasNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class MinutasListener implements ShouldQueue
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

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $minuta = Minutasaltadireccion::with('participantes')->where('id', $event->minutas->id)->first();

        $participantEmails = $minuta->participantes->pluck('email')->map(function ($email) {
            return trim($this->removeUnicodeCharacters($email));
        });

        // Obtener los usuarios correspondientes a esos correos electrónicos
        $users = User::whereIn('email', $participantEmails)->get();

        // Enviar la notificación a cada usuario
        Notification::send($users, new MinutasNotification($event->minutas, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}
