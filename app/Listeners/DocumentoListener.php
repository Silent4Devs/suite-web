<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\User;
use App\Notifications\DocumentoNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class DocumentoListener implements ShouldQueue
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
        try {
            $elaborador = Empleado::where('id', $event->documento->elaboro_id)->first();
            $elabor = User::where('email', trim(removeUnicodeCharacters($elaborador->email)))->first();
            Notification::send($elabor, new DocumentoNotification($event->documento, $event->tipo_consulta, $event->tabla, $event->slug));
            $revisor_emple = Empleado::where('id', $event->documento->reviso_id)->first();
            $revisor = User::where('email', trim(removeUnicodeCharacters($revisor_emple->email)))->first();
            Notification::send($revisor, new DocumentoNotification($event->documento, $event->tipo_consulta, $event->tabla, $event->slug));
            $aprobador = Empleado::where('id', $event->documento->aprobo_id)->first();
            $aprobo = User::where('email', trim(removeUnicodeCharacters($aprobador->email)))->first();
            Notification::send($aprobo, new DocumentoNotification($event->documento, $event->tipo_consulta, $event->tabla, $event->slug));
            $responsable = Empleado::where('id', $event->documento->responsable_id)->first();
            $respo = User::where('email', trim(removeUnicodeCharacters($responsable->email)))->first();
            Notification::send($respo, new DocumentoNotification($event->documento, $event->tipo_consulta, $event->tabla, $event->slug));
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
