<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoRecordatorioEvDesempeno extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $empleado;

    public $evaluacion;

    public function __construct($empleado, $evaluacion)
    {
        $this->empleado = $empleado;
        $this->evaluacion = $evaluacion;
    }

    public function build()
    {
        return $this->view('mails.evaluaciones.objetivos.correo-objetivos-pendientes')->subject('Recordatorio Evaluacion: '.$this->empleado->name);
    }
}
