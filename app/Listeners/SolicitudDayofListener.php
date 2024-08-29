<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SolicitudDayofNotification;
use Illuminate\Support\Facades\Notification;

class SolicitudDayofListener
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
        // User::select('users.id', 'users.name', 'users.email', 'role_user.role_id')
        //     ->join('role_user', 'role_user.user_id', '=', 'users.id')
        //     ->where('role_user.role_id', '=', '1')->where('users.id', '!=', auth()->id())
        //     ->get()
        //     ->each(function (User $user) use ($event) {
        //         Notification::send($user, new SolicitudDayofNotification($event->solicitud_dayof, $event->tipo_consulta, $event->tabla, $event->slug));
        //     });
        $user = auth()->user();
        if ($user->empleado && $user->empleado->supervisor) {
            // Obtener al supervisor por su dirección de correo electrónico
            $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
        }
        Notification::send($supervisor, new SolicitudDayofNotification($event->solicitud_dayof, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}
