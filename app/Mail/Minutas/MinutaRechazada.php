<?php

namespace App\Mail\Minutas;

use App\Models\Minutasaltadireccion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MinutaRechazada extends Mailable
{
    use Queueable, SerializesModels;

    public $minuta;

    public function __construct(Minutasaltadireccion $minuta)
    {
        $minuta->load('planes', 'participantes', 'responsable');
        $this->minuta = $minuta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.minutas.documento-no-publicado');
    }
}
