<?php

namespace App\Mail\Minutas;

use App\Models\HistoralRevisionMinuta;
use App\Models\Minutasaltadireccion;
use App\Models\RevisionMinuta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudDeAprobacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $minuta;

    public $revision;

    public $historialRevisionMinuta;

    public function __construct(Minutasaltadireccion $minuta, RevisionMinuta $revision, HistoralRevisionMinuta $historialRevisionMinuta)
    {
        $minuta->load('planes', 'participantes', 'responsable');
        $this->minuta = $minuta;
        $this->revision = $revision;
        $this->historialRevisionMinuta = $historialRevisionMinuta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.minutas.solicitud-aprobacion')->subject('Solicitud Aprobación de Minuta: ' . $this->minuta);;
    }
}
