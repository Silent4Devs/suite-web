<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoCargaObjetivos extends Mailable
{
    use Queueable, SerializesModels;

    // public $empleado;
    public $fecha_in;

    public $fecha_fin;

    public function __construct($fecha_in, $fecha_fin)
    {
        //$this->empleado = $empleado;
        $this->fecha_in = $fecha_in;
        $this->fecha_fin = $fecha_fin;
    }

    public function build()
    {
        return $this->view('mails.evaluaciones.objetivos.correo-carga-objetivos')->subject('Carga de Objetivos');
    }
}
