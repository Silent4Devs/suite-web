<?php

namespace App\Listeners;

use App\Models\ContractManager\Comprador;
use App\Models\DisponibilidadEmpleados;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\ParticipantesListaDistribucion;
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
        $disponibilidad = DisponibilidadEmpleados::where('empleado_id', $supervisor->empleado_id)->first();


        if ($disponibilidad->disponibilidad === 1) {
            Notification::send($supervisor, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));

            $finanzas = User::where('email', $email)->first();

            $disponibilidad_finanzas = DisponibilidadEmpleados::where('empleado_id', $finanzas->empleado_id)->first();

            if ($disponibilidad_finanzas->disponibilidad === 1) {
                Notification::send($finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                $comprador = Comprador::where('id', $event->requisiciones->comprador_id)->first();
                $user_comprador = User::where('name', $comprador->nombre)->first();
                Notification::send($user_comprador, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
            } else {

                $lista_finanzas = ListaDistribucion::with('participantes')->where('id', 5)->first();

                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                Notification::send($users_notificados_finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                $comprador = Comprador::where('id', $event->requisiciones->comprador_id)->first();
                $user_comprador = User::where('name', $comprador->nombre)->first();
                Notification::send($user_comprador, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
            }
        } else {
            // Obtén la lista y los IDs de los empleados
            $lista = ListaDistribucion::with('participantes')->where('id', 8)->first();

            $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista->id)->where('empleado_id', $supervisor->empleado_id)->first();

            $participantes_notificados = ParticipantesListaDistribucion::where('nivel', $participantes->nivel)->get();

            $empleadoIds = $participantes_notificados->pluck('empleado_id')->toArray();

            // Obtener los empleados correspondientes a esos IDs
            $empleados = Empleado::whereIn('id', $empleadoIds)->get();

            $email_noti = $empleados->pluck('email')->toArray();

            $users = User::whereIn('email', $email_noti)->get();

            Notification::send($users, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));

            $finanzas = User::where('email', $email)->first();

            $disponibilidad_finanzas = DisponibilidadEmpleados::where('empleado_id', $finanzas->empleado_id)->first();

            if ($disponibilidad_finanzas->disponibilidad === 1) {
                Notification::send($finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                $comprador = Comprador::where('id', $event->requisiciones->comprador_id)->first();
                $user_comprador = User::where('name', $comprador->nombre)->first();
                Notification::send($user_comprador, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
            } else {
                $lista_finanzas = ListaDistribucion::with('participantes')->where('id', 5)->first();

                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                Notification::send($finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                Notification::send($users_notificados_finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                $comprador = Comprador::where('id', $event->requisiciones->comprador_id)->first();
                $user_comprador = User::where('name', $comprador->nombre)->first();
                Notification::send($user_comprador, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
            }
        }
    }
}