<?php

namespace App\Mail\RH\Evaluaciones;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecordatorioEvaluadores extends Mailable
{
    use Queueable, SerializesModels;

    public $evaluacion;

    public $evaluador;

    public $evaluados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($evaluacion, $evaluador, $evaluados)
    {
        $this->evaluacion = $evaluacion;
        $this->evaluador = $evaluador;
        $this->evaluados = $evaluados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.recursos-humanos.evaluaciones.recordatorio-evaluacion');
    }
}
