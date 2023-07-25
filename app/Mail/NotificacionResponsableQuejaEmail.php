<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\QuejasCliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionResponsableQuejaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $quejas;

    public $empleado;

    public function __construct(QuejasCliente $quejas, Empleado $empleado)
    {
        $this->quejas = $quejas;
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.accioncorrectiva.notificacion-responsable')->subject('Solicitud de atención de la queja con folio '.$this->quejas->folio);
    }
}
