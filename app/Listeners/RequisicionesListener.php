<?php

namespace App\Listeners;

use App\Models\ContractManager\Comprador;
use App\Models\DisponibilidadEmpleados;
use App\Models\Empleado;
use App\Models\FirmasRequisiciones;
use App\Models\ListaDistribucion;
use App\Models\ParticipantesListaDistribucion;
use App\Models\User;
use App\Notifications\RequisicionesNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
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
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first(); //Solicitante
        $empleado = Empleado::where('email', $user->email)->first();
        } catch (\Throwable $th) {
            dd($th);
        }

        // $email = 'lourdes.abadia@silent4business.com'; //Finanzas (Cambiar por la lista)
        try {
            if ($event->tipo_consulta == 'cancelarRequisicion') {

                $firmas = FirmasRequisiciones::where('requisicion_id', $event->requsicion->id)->first();

                $involucradosRQOC = collect();

                // requisiciones
                if ($event->requsicion->firma_solicitante !== null) {
                    $user_solicitante = User::where('empleado_id', $firmas->solicitante->id)
                        ->first();
                    $involucradosRQOC->push($user_solicitante);
                }

                if ($event->requsicion->firma_jefe !== null) {
                    $user_jefe = User::where('empleado_id', $firmas->jefe->id)
                        ->first();
                    $involucradosRQOC->push($user_jefe);
                }

                if ($event->requsicion->firma_finanzas !== null) {
                    $user_finanzas = User::where('empleado_id', $firmas->responsableFinanzas->id)
                        ->first();
                    $involucradosRQOC->push($user_finanzas);
                }

                if ($event->requsicion->firma_compras !== null) {
                    $user_compras = User::where('empleado_id', $firmas->comprador->id)
                        ->first();
                    $involucradosRQOC->push($user_compras);
                }

                foreach ($involucradosRQOC as $keyINV => $involucrado) {
                    // code...
                    Notification::send($involucrado, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                }
            } elseif ($event->tipo_consulta == 'cancelarOrdenCompra') {

                $firmas = FirmasRequisiciones::where('requisicion_id', $event->requsicion->id)->first();

                $involucradosRQOC = collect();

                // ordenes de compra
                if ($event->requsicion->firma_comprador_orden !== null) {

                    $responsableComprador = Comprador::with('user')->where('id', $event->requsicion->comprador_id)->first();
                    $comprador = $this->obtenerComprador($responsableComprador);
                    $user_compras = User::where('empleado_id', $firmas->comprador->id)
                        ->first();

                    $involucradosRQOC->push($user_compras);
                }
                if ($event->requsicion->firma_solicitante_orden !== null) {
                    $solicitante_email = User::where('id', $event->requsicion->id_user);
                    $involucradosRQOC->push($solicitante_email);
                }

                if ($event->requsicion->firma_finanzas_orden !== null) {

                    $listaReq = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
                    $listaPart = $listaReq->participantes;

                    for ($i = 0; $i <= $listaReq->niveles; $i++) {
                        $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

                        if ($responsableNivel) {
                            if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                                $responsable = $responsableNivel->empleado;
                                $user_finanzas = User::where('empleado_id', $responsable->id)
                                    ->first();
                                $involucradosRQOC->push($user_finanzas);
                            }
                        }
                    }
                }

                foreach ($involucradosRQOC as $keyINV => $involucrado) {
                    // code...
                    Notification::send($involucrado, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                }
            } else {


                try {
                    $supervisor = $this->responsableJefe($empleado);

                    $user_jefe = User::where('empleado_id', $supervisor->id)
                        ->first();

                    $responsablefinanzas = $this->responsableFinanzas();

                    if ($supervisor->disponibilidad->disponibilidad === 1) {
                        try {
                            Notification::send($user_jefe, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));

                            $finanzas = User::where('email', $responsablefinanzas->email)->first();

                            $disponibilidad_finanzas = $responsablefinanzas->disponibilidad;

                            if ($disponibilidad_finanzas->disponibilidad === 1) {
                                Notification::send($finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
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

                            $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista->id)->where('empleado_id', $supervisor->id)->first();

                            $participantes_notificados = ParticipantesListaDistribucion::where('nivel', $participantes->nivel)->get();

                            $empleadoIds = $participantes_notificados->pluck('empleado_id')->toArray();

                            // Obtener los empleados correspondientes a esos IDs
                            $empleados = Empleado::whereIn('id', $empleadoIds)->get();

                            $email_noti = $empleados->pluck('email')->toArray();

                            $users = User::whereIn('email', $email_noti)->get();

                            Notification::send($users, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));

                            $finanzas = User::where('email', $responsablefinanzas->email)->first();

                            $disponibilidad_finanzas = $responsablefinanzas->disponibilidad;

                            if ($disponibilidad_finanzas->disponibilidad === 1) {
                                Notification::send($finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                                $comprador = Comprador::where('id', $event->requsicion->comprador_id)->first();
                                $user_comprador = User::where('name', $comprador->nombre)->first();
                                Notification::send($user_comprador, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
                            } else {
                                $lista_finanzas = ListaDistribucion::with('participantes')->where('modelo', 'KatbolRequsicion')->first();

                                $participantes = ParticipantesListaDistribucion::where('modulo_id', $lista_finanzas->id)->pluck('empleado_id')->toArray();
                                $empleados_email = Empleado::whereIn('id', $participantes)->pluck('email')->toArray();

                                $users_notificados_finanzas = User::whereIn('email', $empleados_email)->get();

                                Notification::send($finanzas, new RequisicionesNotification($event->requsicion, $event->tipo_consulta, $event->tabla, $event->slug));
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

    public function responsableJefe($empleado)
    {
        //Llamamos lista de lideres
        $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
        //Traemos participantes
        $listaPart = $listaReq->participantes;

        $jefe = $empleado->supervisor;
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

    public function obtenerComprador($comprador)
    {
        $listaReq = ListaDistribucion::where('modelo', 'Comprador')->first();
        $listaPart = $listaReq->participantes;

        $responsableOG = $listaPart->where('numero_orden', 1)->where('empleado_id', $comprador->user->id)->first();
        $n_part_nivel = $listaPart->where('nivel', $responsableOG->nivel)->count();

        for ($i = 1; $i <= $n_part_nivel; $i++) {
            $responsableNivel = $listaPart->where('nivel', $responsableOG->nivel)->where('numero_orden', $i)->first();

            if ($responsableNivel) {
                if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $responsableNivel->empleado;

                    break;
                }
            }
        }

        return $responsable;
    }
}
