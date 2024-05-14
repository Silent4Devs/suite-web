<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\Timesheet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimesheetSolicitudRechazada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $rechazar;

    public $aprobador;

    public $solicitante;

    public function __construct(Empleado $aprobador, Timesheet $rechazar, Empleado $solicitante)
    {
        $this->rechazar = $rechazar;
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
        return $this->view('mails.timesheet.timesheet_solicitud_rechazada')->subject('Timesheet - Solicitud Rechazada '.$this->rechazar->semana_text);
    }
}
