<?php

namespace App\Mail;

use App\Models\Documento;
use App\Models\RevisionDocumento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentoAprobadoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $documento;

    public $revision;

    public function __construct(Documento $documento, RevisionDocumento $revision)
    {
        $this->documento = $documento;
        $this->revision = $revision;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.documento-aprobado');
    }
}
