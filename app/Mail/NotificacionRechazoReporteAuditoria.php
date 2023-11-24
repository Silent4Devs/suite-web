<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionRechazoReporteAuditoria extends Mailable
{
    use Queueable, SerializesModels;

    public $auditoria;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($auditoria)
    {
        //
        $this->auditoria = $auditoria;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        return $this->view('mails.auditorias.notificacion-auditoria-rechazada')
            ->subject('Rechazo Reporte de auditoria');
    }
}
