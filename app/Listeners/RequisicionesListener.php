<?php

namespace App\Listeners;

use App\Models\ContractManager\Comprador;
use App\Models\ContractManager\Requsicion;
use App\Models\Empleado;
use App\Models\FirmasOrdenesCompra;
use App\Models\FirmasRequisiciones;
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
            $user = User::where('id', $event->requsicion->id_user)->first(); //Solicitante
            $empleado = Empleado::where('email', $user->email)->first();
            $requisicion = Requsicion::where('id', $event->requsicion->id)->first();
        } catch (\Throwable $th) {
            dd($th);
        }

        try {
            if ($event->tipo_consulta == 'cancelarRequisicion') {
                try {
                    $firmas = FirmasRequisiciones::with(
                        'solicitante',
                        'jefe',
                        'responsableFinanzas',
                        'comprador'
                    )->where('requisicion_id', $requisicion->id)->first();

                    // requisiciones
                    if ($event->requsicion->firma_solicitante !== null) {
                        $user_solicitante = User::where('empleado_id', $firmas->solicitante->id)
                            ->first();

                        if ($user_solicitante == null) {
                            $user_solicitante = User::where('email', $firmas->solicitante->email)
                                ->first();
                        }

                        Notification::send($user_solicitante, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                    }

                    if ($event->requsicion->firma_jefe !== null) {
                        $jefe_empleado = $firmas->jefe;

                        $user_jefe = User::where('empleado_id', $jefe_empleado->id)
                            ->first();

                        if ($user_jefe == null) {
                            $user_jefe = User::where('email', $jefe_empleado->email)
                                ->first();
                        }

                        Notification::send($user_jefe, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                    }

                    if ($event->requsicion->firma_finanzas !== null) {
                        $finanzas_empleado = $firmas->responsableFinanzas;

                        $user_finanzas = User::where('empleado_id', $finanzas_empleado->id)
                            ->first();

                        if ($user_finanzas == null) {
                            $user_finanzas = User::where('email', $finanzas_empleado->email)
                                ->first();
                        }

                        Notification::send($user_finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                    }

                    if ($event->requsicion->firma_compras !== null) {
                        $comprador_empleado = $firmas->comprador;

                        $user_compras = User::where('empleado_id', $comprador_empleado->id)
                            ->first();

                        if ($user_compras == null) {
                            $user_compras = User::where('email', $comprador_empleado->email)
                                ->first();
                        }

                        Notification::send($user_compras, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                    }
                } catch (\Throwable $th) {
                    dd($th);
                }
            } elseif ($event->tipo_consulta == 'cancelarOrdenCompra') {
                $firmas = FirmasOrdenesCompra::with(
                    'solicitante',
                    'responsableFinanzas',
                    'comprador'
                )->where('requisicion_id', $requisicion->id)->first();

                // ordenes de compra
                if ($event->requsicion->firma_comprador_orden !== null) {

                    $comprador_empleado = $firmas->comprador;

                    $user_compras = User::where('empleado_id', $comprador_empleado->id)
                        ->first();

                    if ($user_compras == null) {
                        $user_compras = User::where('email', $comprador_empleado->email)
                            ->first();
                    }

                    Notification::send($user_compras, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                }

                if ($event->requsicion->firma_solicitante_orden !== null) {

                    $user_solicitante = User::where('empleado_id', $firmas->solicitante->id)
                        ->first();

                    if ($user_solicitante == null) {
                        $user_solicitante = User::where('email', $firmas->solicitante->email)
                            ->first();
                    }

                    Notification::send($user_solicitante, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                }
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
                            Notification::send($user_jefe, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));

                            $disponibilidad_finanzas = $finanzas_empleado->disponibilidad;

                            if ($disponibilidad_finanzas->disponibilidad === 1) {
                                Notification::send($user_finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $event->requsicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            } else {

                                $lista_finanzas = ListaDistribucion::with('participantes')->where('id', 5)->first();

                                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                                Notification::send($users_notificados_finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $event->requsicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
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

                            Notification::send($users, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));

                            $disponibilidad_finanzas = $finanzas_empleado->disponibilidad;

                            if ($disponibilidad_finanzas->disponibilidad === 1) {
                                Notification::send($user_finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $event->requsicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            } else {
                                $lista_finanzas = ListaDistribucion::with('participantes')->where('modelo', 'KatbolRequsicion')->first();

                                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                                Notification::send($user_finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                Notification::send($users_notificados_finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $event->requsicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            }
                        } catch (\Throwable $th) {
                            dd($th);
                        }
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($th);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
