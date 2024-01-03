<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMinutaRechazada extends Mailable
{
    use Queueable, SerializesModels;

    public $tema_minuta;

    public function __construct($tema_minuta)
    {
        $this->tema_minuta = $tema_minuta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.minutas.notificacion-minuta-rechazada')->subject('Minuta Rechazada: '.$this->tema_minuta)->cc('gestiondetalento@silent4business.com');
    }
}
