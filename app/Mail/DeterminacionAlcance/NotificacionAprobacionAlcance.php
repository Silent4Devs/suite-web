<?php

namespace App\Mail\DeterminacionAlcance;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class NotificacionAprobacionAlcance extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.alcance-sgsi.notificacion-alcance-aprobada')->subject('Determinación de Alcance Aprobado: '.$this->nombre);
    }
}
