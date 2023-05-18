<?php

namespace App\Mail\Visitantes;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarIngresoVisitante extends Mailable
{
    use Queueable, SerializesModels;

    public $visitante;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($visitante)
    {
        $this->visitante = $visitante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.visitantes.notificar-visitante')->subject('Notificación de Visita');
    }
}
