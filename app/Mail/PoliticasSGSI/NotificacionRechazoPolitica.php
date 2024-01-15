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
    public $analisis;

    public function __construct($analisis)
    {
        $this->analisis = $analisis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.politicas.notificacion-politica-rechazada')->subject('Política del SGSI Rechazada: ' . $this->analisis);
    }
}
