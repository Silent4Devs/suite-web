<?php

namespace App\Jobs;

use App\Mail\RH\Evaluaciones\NotificacionEvaluador;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotificacionEvaluacion360 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    public $evaluacion;

    public $evaluador;

    public $evaluado;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $evaluacion, $evaluador, $evaluado)
    {
        $this->email = $email;
        $this->evaluacion = $evaluacion;
        $this->evaluador = $evaluador;
        $this->evaluado = $evaluado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new NotificacionEvaluador($this->evaluacion, $this->evaluador, $this->evaluados));
    }
}
