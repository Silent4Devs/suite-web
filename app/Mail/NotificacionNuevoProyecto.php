<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionNuevoProyecto extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto;

    public $identificador;

    public $cliente;

    public $empleado;

    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proyecto, $identificador, $cliente, $empleado, $id)
    {
        //
        $this->proyecto = $proyecto;
        $this->identificador = $identificador;
        $this->cliente = $cliente;
        $this->empleado = $empleado;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        return $this->view('mails.timesheet.timesheet_nuevo_proyecto')
            ->subject('Creacion de Proyecto: '.$this->proyecto);
    }
}
