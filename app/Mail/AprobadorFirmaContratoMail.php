<?php

namespace App\Mail;

use App\Models\AprobadorFirmaContrato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobadorFirmaContratoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $aprobador_firma_contrato;

    public function __construct(AprobadorFirmaContrato $aprobador_firma_contrato)
    {
        $this->aprobador_firma_contrato = $aprobador_firma_contrato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.aprobador-firma-contrato')->subject('Contrato - Solicitud de aprobación de registro');
    }
}
