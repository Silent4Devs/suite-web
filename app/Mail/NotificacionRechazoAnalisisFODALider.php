<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionRechazoAnalisisFODALider extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id;

    public $analisis;

    public function __construct($id, $analisis)
    {
        $this->id = $id;
        $this->analisis = $analisis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.entendimiento-organizacion.notificacion-analisis-lider')->subject('Analisis FODA Rechazado: ' . $this->analisis);
    }
}
