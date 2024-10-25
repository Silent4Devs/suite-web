<?php

namespace App\Jobs;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\EntendimientoOrganizacionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class EntendimientoOrganizacionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $entendimiento;

    protected $tipo_consulta;

    protected $tabla;

    protected $slug;

    public function __construct($entendimiento, $tipo_consulta, $tabla, $slug)
    {
        $this->entendimiento = $entendimiento;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', 'EntendimientoOrganizacion')->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new EntendimientoOrganizacionNotification($this->entendimiento, $this->tipo_consulta, $this->tabla, $this->slug));
        }
    }
}
