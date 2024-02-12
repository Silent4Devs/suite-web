<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RespuestaVacaciones extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitante;

    public $supervisor;

    public $solicitud;

    public $copias;

    public function __construct($solicitante, $supervisor, $solicitud, $copias = [])
    {
        $this->solicitante = $solicitante;
        $this->supervisor = $supervisor;
        $this->solicitud = $solicitud;
        $this->copias = $copias;
    }

    public function build()
    {
        return $this->view('mails.Vacaciones.aprobacion')->subject('Respuesta de tu Solicitud de Vacaciones')->cc($this->copias);
    }
}
