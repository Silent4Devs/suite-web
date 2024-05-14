<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionSolicitudAprobacionAnalisisFODA extends Mailable
{
    use Queueable, SerializesModels;

    public $id_foda;

    public $nombre_analisis;

    public function __construct($id_foda, $nombre_analisis)
    {
        $this->nombre_analisis = $nombre_analisis;
        $this->id_foda = $id_foda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.entendimiento-organizacion.notificacion-analisis-participantes')->subject('Solicitud Aprobación de Analisis FODA: '.$this->nombre_analisis);
    }
}
