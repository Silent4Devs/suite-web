<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RespuestaDayOff extends Mailable
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.Dayoff.aprobacion')->subject('Respuesta de tu solicitud de Day-Off');
    }
}
