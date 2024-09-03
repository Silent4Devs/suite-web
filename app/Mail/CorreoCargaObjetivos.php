<?php

namespace App\Mail;

use Carbon\Carbon;
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
        // Formatear las fechas al formato d-m-Y
        $this->fecha_in = Carbon::parse($fecha_in)->format('d-m-Y');
        $this->fecha_fin = Carbon::parse($fecha_fin)->format('d-m-Y');
    }

    public function build()
    {
        return $this->view('mails.evaluaciones.objetivos.correo-carga-objetivos')->subject('Carga de Objetivos');
    }
}
