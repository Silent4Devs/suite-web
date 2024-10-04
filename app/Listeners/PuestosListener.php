<?php

namespace App\Listeners;

use App\Models\FirmaModule;
use App\Models\User;
use App\Notifications\PuestosNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PuestosListener implements ShouldQueue
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
        // $puestos = FirmaModule::where('modulo_id', '4')->where('submodulo_id', '9')->first();

        // if ($puestos) {
        //     // Decodificar el JSON para obtener los participantes
        //     $participantes = json_decode($puestos->participantes, true);
        
        //     // Obtener los usuarios correspondientes a esos correos electrónicos o IDs
        //     $users = User::whereIn('id', $participantes)->get();
        
        //     // Enviar la notificación a cada usuario
        //     Notification::send($users, new PuestosNotification($event->puestos, $event->tipo_consulta, $event->tabla, $event->slug));
        // } else {
        //     // Manejar el caso cuando no se encuentra el registro
        //     return view('admin.empleados.index');
        //     // Puedes lanzar una excepción o hacer otra cosa en caso de que sea necesario.
        // }
        
    }
}
