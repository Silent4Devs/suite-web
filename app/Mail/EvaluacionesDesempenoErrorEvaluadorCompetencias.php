<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluacionesDesempenoErrorEvaluadorCompetencias extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre_evaluacion;

    protected $evaluados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre_evaluacion, $evaluados)
    {
        //$nombre_evaluacion
        $this->nombre_evaluacion = $nombre_evaluacion;
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
            ->subject('Evaluacion '.$this->nombre_evaluacion.': Error con Evaluadores - Competencias')
            ->view(
                'mails.evaluaciones.evaluadores.problemaEvaluadoresCompetencias',
                [
                    'nombre_evaluacion' => $this->nombre_evaluacion,
                    'evaluados' => $this->evaluados,
                ]
            );
    }
}
