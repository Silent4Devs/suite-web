<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeclaracionAplicabilidadIso extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $tipo;

    public $nombre;

    public $controles_name;

    //inicializa de la clase
    public function __construct($nombre, $tipo, $controles_name)
    {
        $this->tipo = $tipo;
        $this->nombre = $nombre;
        $this->controles_name = $controles_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.paneldeclaracion2022.mail.notificacion');
    }
}
