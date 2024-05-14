<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudMensajeria extends Mailable
{
    use Queueable, SerializesModels;

    public $coordinador;

    public $solicitante;

    public $solicitud;

    public function __construct($solicitante, $coordinador, $solicitud)
    {
        $this->coordinador = $coordinador;
        $this->solicitante = $solicitante;
        $this->solicitud = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mensajeria.solicitud')->subject('Solicitud de Mensajería de: '.$this->solicitante->name);
    }
}
