<?php

namespace App\Jobs;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\AlcancesNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class AlcanceSgsiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $alcances;

    protected $tipo_consulta;

    protected $tabla;

    protected $slug;

    public function __construct($alcances, $tipo_consulta, $tabla, $slug)
    {
        $this->alcances = $alcances;
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
    public function handle()
    {
        try {
            // Cargar la lista de distribución
            $lista = ListaDistribucion::with('participantes')->where('modelo', 'AlcanceSgsi')->first();

            if ($lista) {
                foreach ($lista->participantes as $participante) {
                    // Cargar el empleado
                    $empleado = Empleado::find($participante->empleado_id);

                    if ($empleado) {
                        // Buscar el usuario por email
                        $user = User::where('email', trim(removeUnicodeCharacters($empleado->email)))->first();

                        if ($user) {
                            // Enviar la notificación
                            Notification::send($user, new AlcancesNotification($this->alcances, $this->tipo_consulta, $this->tabla, $this->slug));
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return view('errors.alerta_error', compact('e'));
        }
    }
}
