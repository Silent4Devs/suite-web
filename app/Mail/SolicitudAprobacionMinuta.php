<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAprobacionMinuta extends Mailable
{
    use Queueable, SerializesModels;

    public $id_minuta;
    public $tema_minuta;

    public function __construct($id_minuta, $tema_minuta)
    {
        $this->id_minuta = $id_minuta;
        $this->tema_minuta = $tema_minuta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.minutas.notificacion-minuta-participantes')->subject('Solicitud Aprobación de Minuta: ' . $this->tema_minuta)->cc('gestiondetalento@silent4business.com');
    }
}
