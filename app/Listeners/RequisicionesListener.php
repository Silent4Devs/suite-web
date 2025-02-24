<?php

namespace App\Listeners;

use App\Models\ContractManager\Comprador;
use App\Models\ContractManager\Requsicion;
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
        // //Colaboradores
        try {
            $requisicion = Requsicion::where('id', $event->requisicion->id)->first();
            $user = User::where('id', $requisicion->id_user)->first(); // Solicitante
            $empleado = Empleado::where('email', $user->email)->first();
        } catch (\Throwable $th) {
            dd($th);
        }

        try {
            if ($event->tipo_consulta == 'cancelarRequisicion') {
                try {
                    $user_solicitante = User::where('id', $event->requisicion->id_user)
                        ->first();

                    Notification::send($user_solicitante, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));

                } catch (\Throwable $th) {
                    dd($th);
                }
            } elseif ($event->tipo_consulta == 'cancelarOrdenCompra') {

                $user_solicitante = User::where('id', $event->requisicion->id_user)
                    ->first();

                Notification::send($user_solicitante, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));

            } else {

                try {
                    $jefe_empleado = $requisicion->obtener_responsable_lider;

                    $user_jefe = User::where('empleado_id', $jefe_empleado->id)
                        ->first();

                    if ($user_jefe == null) {
                        $user_jefe = User::where('email', $jefe_empleado->email)
                            ->first();
                    }

                    $finanzas_empleado = $requisicion->obtener_responsable_finanzas;

                    $user_finanzas = User::where('empleado_id', $finanzas_empleado->id)
                        ->first();

                    if ($user_finanzas == null) {
                        $user_finanzas = User::where('email', $finanzas_empleado->email)
                            ->first();
                    }

                    if ($jefe_empleado->disponibilidad->disponibilidad === 1) {
                        try {
                            Notification::send($user_jefe, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));

                            $disponibilidad_finanzas = $finanzas_empleado->disponibilidad;

                            if ($disponibilidad_finanzas->disponibilidad === 1) {
                                Notification::send($user_finanzas, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $requisicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            } else {

                                $lista_finanzas = ListaDistribucion::with('participantes')->where('id', 5)->first();

                                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                                Notification::send($users_notificados_finanzas, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $requisicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            }
                        } catch (\Throwable $th) {
                            dd($th);
                        }
                    } else {
                        try {
                            // Obtén la lista y los IDs de los empleados
                            $lista = ListaDistribucion::with('participantes')->where('modelo', 'Empleado')->first();

                            $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista->id)->where('empleado_id', $jefe_empleado->id)->first();

                            $participantes_notificados = ParticipantesListaDistribucion::where('nivel', $participantes->nivel)->get();

                            $empleadoIds = $participantes_notificados->pluck('empleado_id')->toArray();

                            // Obtener los empleados correspondientes a esos IDs
                            $empleados = Empleado::whereIn('id', $empleadoIds)->get();

                            $email_noti = $empleados->pluck('email')->toArray();

                            $users = User::whereIn('email', $email_noti)->get();

                            Notification::send($users, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));

                            $disponibilidad_finanzas = $finanzas_empleado->disponibilidad;

                            if ($disponibilidad_finanzas->disponibilidad === 1) {
                                Notification::send($user_finanzas, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $requisicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            } else {
                                $lista_finanzas = ListaDistribucion::with('participantes')->where('modelo', 'KatbolRequsicion')->first();

                                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                                Notification::send($user_finanzas, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                Notification::send($users_notificados_finanzas, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $requisicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($requisicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            }
                        } catch (\Throwable $th) {
                            dd($th);
                        }
                    }
                } catch (\Throwable $th) {
                    // throw $th;
                    dd($th);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
