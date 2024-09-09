<?php

namespace App\Listeners;

use App\Models\AprobadorSeleccionado;
use App\Models\User;
use App\Notifications\IncidentesDeSeguridadNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class IncidentesDeSeguridadListener implements ShouldQueue
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
        $incidente = $event->incidentesSeguridad; // Asegúrate de que $event->incidentesDeSeguridad es del tipo correcto
        $tipo_consulta = 'update'; // Asigna el valor correspondiente
        $tabla = 'incidentes_de_seguridads'; // Asigna el valor correspondiente
        $slug = 'Incidente de Seguridad'; // Asigna el valor correspondiente

        $aprobadores_query = AprobadorSeleccionado::where('seguridad_id', $event->incidentesSeguridad->id)->get();

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
        Notification::send($usuarios, new IncidentesDeSeguridadNotification($incidente, $tipo_consulta, $tabla, $slug));
    }
}
