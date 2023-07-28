<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionDeclaracionAplicabilidadAprobadores2022 extends Mailable
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

    public $controles;

    public function __construct(Empleado $aprobador, Empleado $responsable, DeclaracionAplicabilidadConcentradoIso $aplicabilidad)
    {
        $this->aprobador = $aprobador;
        $this->aplicabilidad = $aplicabilidad;
        $this->responsable = $responsable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.declaracionAplicabilidad.notificacionDeclaracionAplicabilidadAprobadores')->subject('Solicitud de atención del control '.$this->aplicabilidad->gapdos->control_iso);
    }
}
