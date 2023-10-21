<?php

namespace App\Console;

use App\Console\Commands\EnviarCorreoFelicitaciones;
use App\Console\Commands\NotificarEvaluacion360;
use App\Console\Commands\NotificarRecursos;
use App\Console\Commands\NotificarUsuarioCapacitacion;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NotificarRecursos::class,
        NotificarEvaluacion360::class,
        EnviarCorreoFelicitaciones::class,
        NotificarUsuarioCapacitacion::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('user:recursos')->dailyAt('14:25')->timezone('America/Mexico_City');
        // $schedule->command('notify:ev360')->daily()->timezone('America/Mexico_City');
        // $schedule->command('capacitacion:usuario')
        //     ->everyFiveMinutes();
        //$schedule->command('cache:clearall')->everyTwoHours();
        $schedule->command(EnviarCorreoFelicitaciones::class)
            ->timezone('America/Mexico_City')
            ->dailyAt('10:00')
            ->withoutOverlapping()
            ->onOneServer()
            ->sentryMonitor();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
