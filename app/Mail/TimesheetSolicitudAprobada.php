<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Empleado;
use App\Models\Timesheet;

class TimesheetSolicitudAprobada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $aprobar;
    public $aprobador;
    public $solicitante;

    public function __construct(Empleado $aprobador, Timesheet $aprobar, Empleado $solicitante)
    {
        $this->aprobar = $aprobar;
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
        return $this->view('mails.timesheet.timesheet_solicitud_aprobada');
    }
}
