<?php

namespace App\Console\Commands;

use App\Jobs\EnviarMailCapacitacionesJob;
use App\Mail\InvitacionCapacitaciones;
use App\Models\Recurso;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotificarUsuarioCapacitacion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capacitacion:usuario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar email programado a los usuario participantes en la capacitación';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //One hour is added to compensate for PHP being one hour faster
        $now = Carbon::now()->addHour()->format('Y-m-d h:i');
        logger($now);
        $capacitaciones = Recurso::with('empleados')->all();
        if ($capacitaciones != null) {
            foreach ($capacitaciones as $capacitacion) {
                if ($capacitacion->configuracion_invitacion_envio != null) {
                    $configuracion = $capacitacion->configuracion_invitacion_envio;
                    if ($configuracion->programar_envio) {
                        $fechaEnvioProgramada = Carbon::parse($configuracion->fecha_envio_invitacion)->format('Y-m-d h:i');
                        $empleados = $capacitacion->empleados;
                        if ($fechaEnvioProgramada == $now) {
                            foreach ($empleados as $empleado) {
                                dispatch(
                                    new EnviarMailCapacitacionesJob(
                                        $empleado->email,
                                        new InvitacionCapacitaciones($empleado, $capacitacion)
                                    )
                                );
                            }

                            $capacitacion->update([
                                'estatus' => 'Enviado',
                            ]);
                        }
                    }
                }
            }
        }
    }
}
