<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\TratamientoRiesgo;
use Illuminate\Bus\Queueable;
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
    public $tratamientoRiesgo;

    public $empleado;

    public function __construct(TratamientoRiesgo $tratamientoRiesgo, Empleado $empleado)
    {
        $this->tratamientoRiesgo = $tratamientoRiesgo;
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.tratamientoRiesgos.solicitud-aceptacion-riesgo')->subject('Solicitud de aprobación del riesgo ID ' . $this->tratamientoRiesgo->identificador);
    }
}
