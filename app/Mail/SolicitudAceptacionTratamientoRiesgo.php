<?php

namespace App\Mail;

use App\Models\TratamientoRiesgo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAceptacionTratamientoRiesgo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $tratamiento;

    public function __construct(TratamientoRiesgo $tratamiento)
    {
        $this->planificacionControles = $tratamiento;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.planificacionControles.solicitud-firma-aprobador');
    }
}
