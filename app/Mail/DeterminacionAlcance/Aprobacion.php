<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\Timesheet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class Aprobacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $timesheet_nuevo;

    public $aprobador;

    public $solicitante;

    public function __construct(Empleado $aprobador, Timesheet $timesheet_nuevo, Empleado $solicitante)
    {
        $this->timesheet_nuevo = $timesheet_nuevo;
        $this->aprobador = $aprobador;
        $this->solicitante = $solicitante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fecha = explode('al', $this->timesheet_nuevo->semana_text);
        $fecha_fin = $fecha[1];

        return $this->view('mails.timesheet.timesheet_solicitud_aprobacion')->subject('Timesheet - Solicitud de aprobación de registro de actividades al'.$fecha_fin);
    }
}
