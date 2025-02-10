<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluacionesDesempenoEliminacionEvaluador extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre_evaluacion;

    protected $evaluador;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre_evaluacion, $evaluador)
    {
        // $nombre_evaluacion
        $this->nombre_evaluacion = $nombre_evaluacion;
        $this->evaluador = $evaluador;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('# MAIL_FROM_ADDRESS'), env('# MAIL_FROM_NAME'))
            ->subject('Evaluacion '.$this->nombre_evaluacion.': Evaluador Dado de Baja')
            ->view(
                'mails.evaluaciones.evaluadores.bajaEvaluador',
                [
                    'nombre_evaluacion' => $this->nombre_evaluacion,
                    'evaluador' => $this->evaluador,
                ]
            );
    }
}
