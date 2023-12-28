<?php

namespace App\Mail\PoliticasSGSI;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionRechazoPoliticaLider extends Mailable
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
        return $this->view('mails.politicas.notificacion-politica-lider')->subject('Política del SGSI Rechazada: ' . $this->analisis)->cc('gestiondetalento@silent4business.com');
    }
}
