<?php

namespace App\Mail\DeterminacionAlcance;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class NotificacionSolicitudAprobacionAlcance extends Mailable
{
    use Queueable, SerializesModels;

    public $id_alcance;

    public $nombre;

    public function __construct($id_alcance, $nombre)
    {
        $this->id_alcance = $id_alcance;
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.alcance-sgsi.notificacion-alcance-participantes')->subject('Solicitud Aprobación de Determinación de Alcance: '.$this->nombre);
    }
}
