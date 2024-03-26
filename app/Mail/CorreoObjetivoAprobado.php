<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoObjetivoAprobado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $empleado;
    public $objetivo;

    public function __construct($empleado, $objetivo)
    {
        //
        $this->empleado = $empleado;
        $this->objetivo = $objetivo;
    }

    public function build()
    {
        return $this->view('mails.evaluaciones.objetivos.correo-objetivo-aprobado')->subject('Objetivos Aprobado');
    }
}
