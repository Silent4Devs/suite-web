<?php

namespace App\Mail;

use App\Models\QuejasCliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitarCierreQuejaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $quejas;

    public $evidencia;

    public function __construct(QuejasCliente $quejas, $evidencia = [])
    {
        $this->quejas = $quejas;
        $this->evidencia = $evidencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.accioncorrectiva.SolicitarCierreQueja')->subject('Solicitud de cierre de queja con folio '.$this->quejas->folio);
    }
}
