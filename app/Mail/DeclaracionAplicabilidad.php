<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeclaracionAplicabilidad extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $tipo;

    public $nombre;

    public $controles;

    //inicializa de la clase
    public function __construct($nombre, $tipo, $controles)
    {
        $this->tipo = $tipo;
        $this->nombre = $nombre;
        $this->controles = $controles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.paneldeclaracion.mail.notificacion');
    }
}
