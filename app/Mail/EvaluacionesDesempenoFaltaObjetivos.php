<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluacionesDesempenoFaltaObjetivos extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre_evaluacion;

    protected $nombre_periodo;

    protected $evaluados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre_evaluacion, $nombre_periodo, $evaluados)
    {
        // $nombre_evaluacion
        $this->nombre_evaluacion = $nombre_evaluacion;
        $this->nombre_periodo = $nombre_periodo;
        $this->evaluados = $evaluados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('# MAIL_FROM_ADDRESS'), env('# MAIL_FROM_NAME'))
            ->subject('Evaluacion '.$this->nombre_evaluacion.':Atención Objetivos Colaboradores')
            ->view(
                'mails.objetivosFaltantes',
                [
                    'nombre_evaluacion' => $this->nombre_evaluacion,
                    'nombre_periodo' => $this->nombre_periodo,
                    'evaluados' => $this->evaluados,
                ]
            );
    }
}
