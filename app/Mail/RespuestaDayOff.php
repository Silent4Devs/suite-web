<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RespuestaDayOff extends Mailable
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.Dayoff.aprobacion')->subject('Respuesta de tu solicitud de Day-Off')->cc($this->copias);
    }
}
