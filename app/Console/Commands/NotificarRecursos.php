<?php

namespace App\Console\Commands;

use App\Models\Recurso;
use App\Notifications\TaskRecursosNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class NotificarRecursos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:recursos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about his resources';

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
        foreach (Recurso::get() as $recurso) {
            $diferencia_dias = Carbon::now()->diffInDays(Carbon::parse($recurso->fecha_curso)->format('d/m/Y'), false);
            if ($diferencia_dias >= 0 && $diferencia_dias <= 3) {
                foreach ($recurso->participantes as $participante) {
                    $mensaje = '';
                    if ($diferencia_dias == 0) {
                        $mensaje = 'Hoy tienes el curso y capacitación siguiente: '.$recurso->cursoscapacitaciones;
                    } elseif ($diferencia_dias == 1) {
                        $mensaje = 'Falta '.$diferencia_dias.' día para el curso y capacitación siguiente: '.$recurso->cursoscapacitaciones;
                    } else {
                        $mensaje = 'Faltan '.$diferencia_dias.' días para el curso y capacitación siguiente: '.$recurso->cursoscapacitaciones;
                    }
                    Notification::send($participante, new TaskRecursosNotification('recurso', 'Recurso', $mensaje, $participante, 'task'));
                }
            }
        }

        return 0;
    }
}
