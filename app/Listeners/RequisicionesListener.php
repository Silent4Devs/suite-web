<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\RequisicionesNotification;
use Illuminate\Support\Facades\Notification;

class RequisicionesListener
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
        $user = auth()->user();
        $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
        Notification::send($supervisor, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
        $finanzas = User::where('email', 'lourdes.abadia@silent4business.com')->first();
        Notification::send($finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}
