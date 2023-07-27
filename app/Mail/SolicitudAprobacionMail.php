<?php

namespace App\Mail;

use App\Models\Documento;
use App\Models\HistorialRevisionDocumento;
use App\Models\RevisionDocumento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAprobacionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $documento;

    public $revision;

    public $historialRevisionDocumento;

    public function __construct(Documento $documento, RevisionDocumento $revision, HistorialRevisionDocumento $historialRevisionDocumento)
    {
        $this->documento = $documento;
        $this->revision = $revision;
        $this->historialRevisionDocumento = $historialRevisionDocumento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.solicitud-aprobacion');
    }
}
