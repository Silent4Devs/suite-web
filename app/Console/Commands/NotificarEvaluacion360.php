<?php

namespace App\Console\Commands;

use App\Jobs\NotificacionEvaluacion360;
use App\Models\Empleado;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluadoEvaluador;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotificarEvaluacion360 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:ev360';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificación para evaluaciones que se generan por periodos';

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
        $now = date('Y-m-d', strtotime(Carbon::now()));
        logger($now);
        $evaluaciones_no_enviadas = Evaluacion::getAll();
        if (!$evaluaciones_no_enviadas) {
            $evaluaciones_no_enviadas->where('fecha_inicio', $now)
                ->where('email_sended', false)->each(function ($evaluacion) {
                    $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->pluck('evaluador_id')->unique()->toArray();
                    foreach ($evaluadores as $evaluador) {
                        $evaluados = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                            ->where('evaluador_id', $evaluador)->pluck('evaluado_id')->unique()->toArray();
                        $evaluados = Empleado::alta()->find($evaluados);
                        $evaluador_model = Empleado::alta()->find($evaluador);
                        dispatch(
                            new NotificacionEvaluacion360(
                                $evaluador_model->email,
                                $evaluacion,
                                $evaluador_model,
                                $evaluados
                            )
                        );
                        // $this->enviarNotificacionAlEvaluador($evaluador_model->email, $evaluacion, $evaluador_model, $evaluados);
                        if (env('APP_ENV') == 'local') { // solo funciona en desarrollo, es una muy mala práctica, es para que funcione con mailtrap y la limitación del plan gratuito
                            if (env('MAIL_HOST') == 'smtp.mailtrap.io') {
                                sleep(1); //use usleep(500000) for half a second or less
                            }
                        }
                    }
                });
        }
    }
}
