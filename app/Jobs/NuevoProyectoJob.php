<?php

namespace App\Jobs;

use App\Mail\NotificacionNuevoProyecto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NuevoProyectoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $proyecto;

    public $identificador;

    public $cliente;

    public $empleado;

    public $email;

    public $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $proyecto, $identificador, $cliente, $empleado, $id)
    {
        //
        $this->email = $email;
        $this->proyecto = $proyecto;
        $this->identificador = $identificador;
        $this->cliente = $cliente;
        $this->empleado = $empleado;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        foreach ($this->email as $correo_participante) {
            Mail::to(removeUnicodeCharacters($correo_participante))
                ->queue(new NotificacionNuevoProyecto($this->proyecto, $this->identificador, $this->cliente, $this->empleado, $this->id));
        }
    }
}
