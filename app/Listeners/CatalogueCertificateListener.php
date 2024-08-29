<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\CatalogueCertificateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class CatalogueCertificateListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 5;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $modulo_entend = 5;
        if ($event->public === 'LD') {
            $lista = ListaDistribucion::with('participantes')->where('id', $modulo_entend)->first();

            foreach ($lista->participantes as $participantes) {
                $empleados = Empleado::where('id', $participantes->empleado_id)->first();

                $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();
                // dd($user);

                Notification::send($user, new CatalogueCertificateNotification($event->certificate, $event->tipo_consulta, $event->tabla, $event->slug));
            }
        } else {
            User::select('users.id', 'users.name', 'users.email', 'role_user.role_id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->where('role_user.role_id', '=', '1')->where('users.id', '!=', auth()->id())
                ->get()
                ->each(function (User $user) use ($event) {
                    Notification::send($user, new CatalogueCertificateNotification($event->certificate, $event->tipo_consulta, $event->tabla, $event->slug));
                });
        }

    }
}
