<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMinutaAprobada extends Mailable
{
    use Queueable, SerializesModels;

    public $responsable;

    public $tema_minuta;

    public function __construct($responsable, $tema_minuta)
    {
        $this->responsable = $responsable;
        $this->tema_minuta = $tema_minuta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.minutas.notificacion-minuta-aprobada')->subject('Minuta Aprobada: '.$this->tema_minuta)->cc('gestiondetalento@silent4business.com');
    }
}
