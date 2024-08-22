<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreacionEvaluacionDesempenoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre_evaluacion;

    public $autor;

    public function __construct($nombre_evaluacion, $autor)
    {
        $this->nombre_evaluacion = $nombre_evaluacion;
        $this->autor = $autor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.evaluaciones.creacionEvaluacionesDesempenoMail')
            ->subject('Nueva Evaluación de Desempeño Creada');
    }
}
