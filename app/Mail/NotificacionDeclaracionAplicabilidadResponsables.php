<?php

namespace App\Mail;

use App\Models\DeclaracionAplicabilidad;
use App\Models\Empleado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionDeclaracionAplicabilidadResponsables extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $aprobador;

    public $aplicabilidad;

    public $responsable;

    public $control;

    public function __construct(Empleado $aprobador, Empleado $responsable, DeclaracionAplicabilidad $aplicabilidad, $control)
    {
        $this->aprobador = $aprobador;
        $this->aplicabilidad = $aplicabilidad;
        $this->responsable = $responsable;
        $this->control = $control;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.declaracionAplicabilidad.notificacionDeclaracionAplicabilidadResponsable')->subject('Aprobación/rechazo del control ' . $this->aplicabilidad->anexo_indice);
    }
}
