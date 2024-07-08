<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluacionesDesempenoFaltaCompetencias extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre_evaluacion;

    protected $nombre_periodo;

    protected $puestos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre_evaluacion, $nombre_periodo, $puestos)
    {
        //$nombre_evaluacion
        $this->nombre_evaluacion = $nombre_evaluacion;
        $this->nombre_periodo = $nombre_periodo;
        $this->puestos = $puestos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('# MAIL_FROM_ADDRESS'), env('# MAIL_FROM_NAME'))
            ->subject('Evaluacion '.$this->nombre_evaluacion.':Colaboradores sin Competencias')
            ->view(
                'mails.evaluaciones.competencias.competenciasFaltantes',
                [
                    'nombre_evaluacion' => $this->nombre_evaluacion,
                    'nombre_periodo' => $this->nombre_periodo,
                    'puestos' => $this->puestos,
                ]
            );
    }
}
