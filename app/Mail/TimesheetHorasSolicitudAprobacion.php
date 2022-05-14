<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Timesheet;
use App\Models\Empleado;
use Illuminate\Queue\SerializesModels;

class TimesheetHorasSolicitudAprobacion extends Mailable
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
        return $this->view('mails.timesheet.timesheet_solicitud_aprobacion');
    }
}
