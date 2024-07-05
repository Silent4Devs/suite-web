<?php

namespace App\Mail;

use App\Models\AprobadorFirmapuesto;
use App\Models\ContractManager\puesto;
use App\Models\Empleado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobadorFirmapuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $aprobador_firma_puesto;

    public function __construct(AprobadorFirmapuesto $aprobador_firma_puesto)
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
