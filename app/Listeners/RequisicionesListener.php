<?php

namespace App\Listeners;

use App\Models\ContractManager\Comprador;
use App\Models\User;
use App\Notifications\RequisicionesNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class RequisicionesListener implements ShouldQueue
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
        $user = auth()->user();
        $email = 'lourdes.abadia@silent4business.com';

        $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
        Notification::send($supervisor, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
        $finanzas = User::where('email', $email)->first();
        Notification::send($finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
        $comprador = Comprador::where('id', $event->requisiciones->comprador_id)->first();
        $user_comprador = User::where('name', $comprador->nombre)->first();
        Notification::send($user_comprador, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}
