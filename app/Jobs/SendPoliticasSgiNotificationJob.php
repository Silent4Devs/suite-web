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

        foreach ($lista->participantes as $participante) {
            $empleados = Empleado::find($participante->empleado_id);
            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            if ($user) {
                Notification::send($user, new PoliticasSgiNotification($this->politicas, $this->tipo_consulta, $this->tabla, $this->slug));
            }
        }
    }
}

