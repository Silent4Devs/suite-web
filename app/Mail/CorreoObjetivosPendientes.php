<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoObjetivosPendientes extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $empleado;

    public $no_objetivos;

    public function __construct($empleado, $no_objetivos)
    {
        //
        $this->empleado = $empleado;
        $this->no_objetivos = $no_objetivos;
    }

    public function build()
    {
        return $this->view('mails.evaluaciones.objetivos.correo-objetivos-pendientes')->subject('Objetivos Pendientes: '.$this->empleado->name);
    }
}
