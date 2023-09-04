<?php

namespace App\Mail\Visitantes;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudSalidaVisitante extends Mailable
{
    use Queueable, SerializesModels;

    public $visitante;

    public $responsable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($visitante, $responsable)
    {
        $this->visitante = $visitante;
        $this->responsable = $responsable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.visitantes.solicitudSalida')->subject('Solicitud de Salida de ' . $this->visitante->nombre);
    }
}
