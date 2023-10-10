<?php

namespace App\Mail\RH\Evaluaciones;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CitaEvaluadorEvaluado extends Mailable
{
    use Queueable, SerializesModels;

    public $evaluacion;

    public $evaluador;

    public $evaluado;

    public $enlace;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($evaluacion, $evaluador, $evaluado, $enlace)
    {
        $this->evaluacion = $evaluacion;
        $this->evaluador = $evaluador;
        $this->evaluado = $evaluado;
        $this->enlace = $enlace;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.recursos-humanos.evaluaciones.cita-evaluado-evaluador');
    }
}
