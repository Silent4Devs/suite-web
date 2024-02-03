<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudDayOff extends Mailable
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
        return $this->view('mails.Dayoff.solicitud')->subject('Solicitud de Day-Off de: ' . $this->solicitante->name)->cc($this->copias);
    }
}
