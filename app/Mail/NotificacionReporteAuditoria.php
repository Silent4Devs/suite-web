<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionReporteAuditoria extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre_colaborador;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre_colaborador, $url)
    {
        //
        $this->nombre_colaborador = $nombre_colaborador;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        return $this->view('mails.auditorias.notificacion-auditoria-lider')
            ->subject('Reporte de auditoria: '.$this->nombre_colaborador);
    }
}
