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
        //Colaboradores
        $user = User::getCurrentUser(); //Solicitante
        // $email = 'lourdes.abadia@silent4business.com'; //Finanzas (Cambiar por la lista)

        //Hay que buscar al supervisor de acuerdo a la lista y disponibilidad
        // $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
        // $disponibilidad = DisponibilidadEmpleados::where('empleado_id', $supervisor->empleado_id)->first();

        try {
            $supervisor = $this->responsableJefe($user);
            $responsablefinanzas = $this->responsableFinanzas();

            if ($supervisor->disponibilidad === 1) {
                Notification::send($supervisor, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));

                $finanzas = User::where('email', $responsablefinanzas->email)->first();

                $disponibilidad_finanzas = $responsablefinanzas->disponibilidad;

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
                $lista = ListaDistribucion::with('participantes')->where('modelo', 'Empleado')->first();

                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista->id)->where('empleado_id', $supervisor->id)->first();

                $participantes_notificados = ParticipantesListaDistribucion::where('nivel', $participantes->nivel)->get();

                $empleadoIds = $participantes_notificados->pluck('empleado_id')->toArray();

                // Obtener los empleados correspondientes a esos IDs
                $empleados = Empleado::whereIn('id', $empleadoIds)->get();

                $email_noti = $empleados->pluck('email')->toArray();

                $users = User::whereIn('email', $email_noti)->get();

                Notification::send($users, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));

                $finanzas = User::where('email', $responsablefinanzas->email)->first();

                $disponibilidad_finanzas = $responsablefinanzas->disponibilidad;

                if ($disponibilidad_finanzas->disponibilidad === 1) {
                    Notification::send($finanzas, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                    $comprador = Comprador::where('id', $event->requisiciones->comprador_id)->first();
                    $user_comprador = User::where('name', $comprador->nombre)->first();
                    Notification::send($user_comprador, new RequisicionesNotification($event->requisiciones, $event->tipo_consulta, $event->tabla, $event->slug));
                } else {
                    $lista_finanzas = ListaDistribucion::with('participantes')->where('modelo', 'KatbolRequsicion')->first();

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
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function responsableJefe($user)
    {
        //Llamamos lista de lideres
        $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
        //Traemos participantes
        $listaPart = $listaReq->participantes;

        $jefe = $user->empleado->supervisor;
        //Buscamos al supervisor por su id
        $supList = $listaPart->where('empleado_id', $jefe->id)->first();

        //Buscamos en que nivel se encuentra el supervisor
        $nivel = $supList->nivel;

        //traemos a todos los participantes correspondientes a ese nivel
        $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

        //Buscamos 1 por 1 los participantes del nivel (area)
        foreach ($participantesNivel as $key => $partNiv) {
            //Si su estado esta activo se le manda el correo
            if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {

                $supervisor = $partNiv->empleado;

                break;
            }
        }

        return $supervisor;
    }

    public function responsableFinanzas()
    {
        $listaReq = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
        $listaPart = $listaReq->participantes;

        for ($i = 0; $i <= $listaReq->niveles; $i++) {
            $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

            if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                $responsable = $responsableNivel->empleado;

                break;
            }
        }

        return $responsable;
    }
}
