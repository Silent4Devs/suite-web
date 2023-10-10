<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\TratamientoRiesgo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RiesgoAceptadoRechazado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $tratamientoRiesgo;
    public $tratamientoRiesgo;

    public function __construct(TratamientoRiesgo $tratamientoRiesgo)
    {
        // $this->empleado = $empleado;
        $this->tratamientoRiesgo = $tratamientoRiesgo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.tratamientoRiesgos.riesgo-aceptado-rechazado')->subject('Respuesta a la solicitud de aprobación del riesgo ID ' . $this->tratamientoRiesgo->identificador);
    }
}
