<?php

namespace App\Mail\DeterminacionAlcance;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionRechazoAlcanceLider extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
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
        return $this->view('mails.alcance-sgsi.notificacion-alcance-lider')->subject('Determinación de Alcance Rechazado: '.$this->nombre)->cc('gestiondetalento@silent4business.com');
    }
}
