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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $proyecto, $identificador, $cliente, $empleado)
    {
        //
        $this->email = $email;
        $this->proyecto = $proyecto;
        $this->identificador = $identificador;
        $this->cliente = $cliente;
        $this->empleado = $empleado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->email)->send(new NotificacionNuevoProyecto($this->proyecto, $this->identificador, $this->cliente, $this->empleado));
    }
}
