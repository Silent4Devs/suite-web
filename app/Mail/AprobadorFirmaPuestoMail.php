<?php

namespace App\Mail;

use App\Models\AprobadorFirmaPuesto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobadorFirmaPuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $aprobador_firma_puesto;

    public function __construct(AprobadorFirmaPuesto $aprobador_firma_puesto)
    {
        $this->aprobador_firma_puesto = $aprobador_firma_puesto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.aprobador-firma-puesto')->subject('puesto - Solicitud de aprobación de registro');
    }
}
