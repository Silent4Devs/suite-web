<?php

namespace App\Console\Commands;

use App\Models\Escuela\UserEvaluation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CapacitacionesReactivarIntentos extends Command
{
    protected $nombre;

    protected $correodestinatario;

    protected $cumplehoy;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retry:capacitaciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reactivar Intentos de evaluaciones en Capacitaciones';

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
        // Obtén la fecha y hora actuales
        $tiempo = Carbon::now();
        $tiempoMenosOchoHoras = $tiempo->subHours(8);

        $searchRetrys = UserEvaluation::where('number_of_attempts', 0)
            ->where('score', '<', 100)
            ->where('last_attempt', '<', $tiempoMenosOchoHoras) // Verifica que hayan pasado 8 horas
            ->get();

        foreach ($searchRetrys as $retry) {
            $retry->number_of_attempts = 3;
            $retry->save();
        }
    }
}
