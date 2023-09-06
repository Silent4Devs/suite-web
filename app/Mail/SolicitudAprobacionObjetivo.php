<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAprobacionObjetivo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $objetivo;

    public $empleado;

    public function __construct($objetivo, $empleado)
    {
        $this->objetivo = $objetivo;
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.objetivosEstrategicos.solicitud-aprobacion')->subject('Solicitud de aprobación de objetivo ' . $this->objetivo->nombre);
    }
}
