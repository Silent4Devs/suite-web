<?php

namespace App\Listeners;

use App\Events\SugerenciasEvent;
use App\Models\AprobadorSeleccionado;
use App\Models\User;
use App\Notifications\SugerenciasNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SugerenciasListener implements ShouldQueue
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
    public function handle(SugerenciasEvent $event)
    {
        $sugerencias = $event->sugerencias; // Asegúrate de que $event->sugerencias es del tipo correcto
        $tipo_consulta = 'update'; // Asigna el valor correspondiente
        $tabla = 'sugerencias'; // Asigna el valor correspondiente
        $slug = 'Sugerencia'; // Asigna el valor correspondiente

        $aprobadores_query = AprobadorSeleccionado::where('sugerencias_id', $event->sugerencias->id)->get();

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
        Notification::send($usuarios, new SugerenciasNotification($sugerencias, $tipo_consulta, $tabla, $slug));
    }
}
