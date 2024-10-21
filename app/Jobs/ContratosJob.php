<?php

namespace App\Listeners;

use App\Models\FirmaModule;
use App\Models\User;
use App\Notifications\ContratoNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ContratosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contratos;

    protected $tipo_consulta;

    protected $tabla;

    protected $slug;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($contratos, $tipo_consulta, $tabla, $slug)
    {
        $this->contratos = $contratos;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $firma = FirmaModule::where('modulo_id', '2')->where('submodulo_id', '7')->first();

            // Decodifica el campo participantes
            $participantes = json_decode($firma->participantes);

            // Si es necesario, convierte a un array (por si acaso json_decode devuelve un objeto)
            if (is_object($participantes)) {
                $participantes = (array) $participantes;
            }

            // Obtén los usuarios cuyos IDs están en el campo participantes
            $usuarios = User::whereIn('id', $participantes)->get();

            // Enviar la notificación a cada usuario
            Notification::send($usuarios, new ContratoNotification($event->contratos, $event->tipo_consulta, $event->tabla, $event->slug));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
