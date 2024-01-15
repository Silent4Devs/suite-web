<?php

namespace App\Mail\PoliticasSGSI;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionRechazoPolitica extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $nombre_politica;

    public function __construct($nombre_politica)
    {
        $this->nombre_politica = $nombre_politica;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.politicas.notificacion-politica-rechazada')->subject('Política del SGSI Rechazada: ' . $this->nombre_politica);
    }
}
