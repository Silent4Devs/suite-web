<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitacionCapacitacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;

    public $recurso;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empleado, $recurso)
    {
        $this->empleado = $empleado;
        $this->recurso = $recurso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.capacitaciones.invitacion-capacitacion', ['empleado' => $this->empleado, 'recurso' => $this->recurso]);
    }
}
