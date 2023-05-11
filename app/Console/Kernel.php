<?php

namespace App\Console;

use App\Console\Commands\EnviarCorreoFelicitaciones;
use App\Console\Commands\NotificarEvaluacion360;
use App\Console\Commands\NotificarRecursos;
use App\Console\Commands\NotificarUsuarioCapacitacion;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\EnviarMailFelicitacionJob;

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('user:recursos')->dailyAt('14:25')->timezone('America/Mexico_City');
        // $schedule->command('notify:ev360')->daily()->timezone('America/Mexico_City');
        // $schedule->command('capacitacion:usuario')
        //     ->everyFiveMinutes();
        // $schedule->command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everySixHours();
        $schedule->command('cache:clearall')->everyMinute();
        $schedule->job(new EnviarMailFelicitacionJob)
        ->everyFiveMinutes();
        // ->timezone('America/Mexico_City')
        // ->dailyAt('10:00');
        // $schedule->job(new EnviarMailFelicitacionJob)->dailyAt('10:36')->timezone('America/Mexico_City');
        // $schedule->command(EnviarCorreoFelicitaciones::class)->dailyAt('10:47')->timezone('America/Mexico_City');
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
