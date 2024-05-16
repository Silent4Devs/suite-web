<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\TimesheetNotification;
use Illuminate\Support\Facades\Notification;

class TimesheetListener
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
        $supervisor = User::where('email', removeUnicodeCharacters($user->empleado->supervisor->email))->first();
        Notification::send($supervisor, new TimesheetNotification($event->timeshet, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}