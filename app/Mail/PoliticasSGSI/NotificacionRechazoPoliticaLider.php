<?php

namespace App\Mail\PoliticasSGSI;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionRechazoPoliticaLider extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id_politica;

    public $nombre_politica;

    public function __construct($id_politica, $nombre_politica)
    {
        $this->id_politica = $id_politica;
        $this->nombre_politica = $nombre_politica;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.politicas.notificacion-politica-lider')->subject('Política del SGSI Rechazada: ' . $this->nombre_politica)->cc('gestiondetalento@silent4business.com');
    }
}
