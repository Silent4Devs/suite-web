<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionAprobacionSuperAprobadorAnalisisFODA extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id_foda;
    public $nombre_analisis;

    public function __construct($id_foda, $nombre_analisis)
    {
        $this->id_foda = $id_foda;
        $this->nombre_analisis = $nombre_analisis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.entendimiento-organizacion.notificacion-analisis-participantes')->subject('Solicitud Aprobación de Analisis FODA: ' . $this->nombre_analisis);
    }
}
