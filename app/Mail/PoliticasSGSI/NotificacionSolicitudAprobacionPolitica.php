<?php

namespace App\Mail\PoliticasSGSI;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionSolicitudAprobacionPolitica extends Mailable
{
    use Queueable, SerializesModels;

    public $id_politica;
    public $nombre_politica;

    public function __construct($nombre_politica)
    {
        $this->nombre_politica = $nombre_politica;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.politicas.notificacion-politica-participantes')->subject('Solicitud Aprobación de Politica: ' . $this->nombre_politica);
    }
}
