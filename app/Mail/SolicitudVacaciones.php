<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudVacaciones extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitante;
    public $supervisor;
    public $solicitud;

    public function __construct($solicitante,$supervisor,$solicitud)
    {
        $this->solicitante = $solicitante;
        $this->supervisor = $supervisor;
        $this->solicitud = $solicitud;

    }

   
    public function build()
    {
        return $this->view('mails.vacaciones.solicitud')->subject('Solicitud de Vacaciones de: ' . $this->solicitante->name);
    }
}
