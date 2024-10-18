<?php

namespace App\Jobs;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\PoliticasSgiNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendPoliticasSgiNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $politicas;
    protected $tipo_consulta;
    protected $tabla;
    protected $slug;

    public function __construct($politicas, $tipo_consulta, $tabla, $slug)
    {
        $this->politicas = $politicas;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function handle()
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', 'PoliticaSgsi')->first();

        if (!$lista) {
            Log::error('No se encontró la lista de distribución para PoliticaSgsi.');
            return;
        }

        if ($lista->participantes->isEmpty()) {
            Log::error('La lista de distribución no tiene participantes.');
            return;
        }

        foreach ($lista->participantes as $participante) {
            $empleados = Empleado::find($participante->empleado_id);

            if (!$empleados) {
                Log::error('Empleado no encontrado para el ID: ' . $participante->empleado_id);
                continue;
            }

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            if (!$user) {
                Log::error('Usuario no encontrado para el correo: ' . $empleados->email);
                continue;
            }

            try {
                Notification::send($user, new PoliticasSgiNotification($this->politicas, $this->tipo_consulta, $this->tabla, $this->slug));
            } catch (\Exception $e) {
                Log::error('Error al enviar la notificación: ' . $e->getMessage());
            }
        }
    }
}
