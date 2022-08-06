<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudPermisoGoceSueldo extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitante;
    public $supervisor;
    public $solicitud;

    public function __construct($solicitante, $supervisor, $solicitud)
    {
        $this->solicitante = $solicitante;
        $this->supervisor = $supervisor;
        $this->solicitud = $solicitud;
    }


    public function build()
    {
        return $this->view('mails.PermisoGoceSueldo.solicitud')->subject('Solicitud de Permiso con Goce de Sueldo de: ' . $this->solicitante->name);
    }
}
