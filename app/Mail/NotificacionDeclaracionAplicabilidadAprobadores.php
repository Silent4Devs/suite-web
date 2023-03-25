<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\DeclaracionAplicabilidad;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionDeclaracionAplicabilidadAprobadores extends Mailable
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

    public function __construct(Empleado $aprobador, Empleado $responsable, DeclaracionAplicabilidad $aplicabilidad)
    {
        $this->aprobador = $aprobador;
        $this->aplicabilidad =$aplicabilidad;
        $this->responsable = $responsable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.declaracionAplicabilidad.notificacionDeclaracionAplicabilidadAprobadores')->subject('Solicitud de atención del control ' . $this->aplicabilidad->anexo_indice);
    }
}
