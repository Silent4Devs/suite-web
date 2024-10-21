<?php

namespace App\Listeners;

use App\Models\AprobadorSeleccionado;
use App\Models\User;
use App\Notifications\RiesgoNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class RiesgosListener implements ShouldQueue
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
        $riesgos = $event->riesgos; // Asegúrate de que $event->riesgos es del tipo correcto
        $tipo_consulta = 'update'; // Asigna el valor correspondiente
        $tabla = 'riesgos_identificados'; // Asigna el valor correspondiente
        $slug = 'Riesgo'; // Asigna el valor correspondiente

        $aprobadores_query = AprobadorSeleccionado::where('riesgos_id', $event->riesgos->id)->get();

        // Extraer los IDs de los aprobadores
        $aprobadoresIds = [];
        foreach ($aprobadores_query as $aprobador) {
            $ids = json_decode($aprobador->aprobadores, true);
            if (is_array($ids)) {
                $aprobadoresIds = array_merge($aprobadoresIds, $ids);
            }
        }

        // Asegurarse de que los IDs son únicos
        $aprobadoresIds = array_unique($aprobadoresIds);

        // Obtener los usuarios correspondientes
        $usuarios = User::whereIn('id', $aprobadoresIds)->get();

        // Enviar la notificación a cada usuario
        Notification::send($usuarios, new RiesgoNotification($riesgos, $tipo_consulta, $tabla, $slug));
    }
}
