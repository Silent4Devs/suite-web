<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RespuestaPermisoGoceSueldo extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitante;
    public $supervisor;
    public $solicitud;

    public function __construct($solicitante,$supervisor,$solicitud)
    {
        $this->solicitante = $solicitante;
        $this->supervisor = $supervisor;
        $this->solicitud = $solicitud;
    }

   
    public function build()
    {
        return $this->view('mails.PermisoGoceSueldo.aprobacion')->subject('Respuesta de tu solicitud de Permiso con Goce de Sueldo');
    }
}
