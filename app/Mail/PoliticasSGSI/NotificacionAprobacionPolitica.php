<?php

namespace App\Mail\PoliticasSGSI;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionAprobacionPolitica extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
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
        return $this->view('mails.politicas.notificacion-politica-aprobada')->subject('Politica Aprobada: ' . $this->nombre_politica);
    }
}
