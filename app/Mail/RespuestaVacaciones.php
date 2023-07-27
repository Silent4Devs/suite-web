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

    public function __construct($solicitante, $supervisor, $solicitud)
    {
        $this->solicitante = $solicitante;
        $this->supervisor = $supervisor;
        $this->solicitud = $solicitud;
    }

    public function build()
    {
        return $this->view('mails.Vacaciones.aprobacion')->subject('Respuesta de tu Solicitud de Vacaciones')->cc('gestiondetalento@silent4business.com');
    }
}
