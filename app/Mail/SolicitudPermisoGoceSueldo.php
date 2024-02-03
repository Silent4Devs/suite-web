<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudPermisoGoceSueldo extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitante;

    public $supervisor;

    public $solicitud;

    public $copias;

    public function __construct($solicitante, $supervisor, $solicitud, $copias = [])
    {
        $this->solicitante = $solicitante;
        $this->supervisor = $supervisor;
        $this->solicitud = $solicitud;
        $this->copias = $copias;
    }

    public function build()
    {
        return $this->view('mails.PermisoGoceSueldo.solicitud')->subject('Solicitud de Permiso de: ' . $this->solicitante->name)->cc($this->copias);
    }
}
