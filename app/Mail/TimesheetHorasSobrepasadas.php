<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimesheetHorasSobrepasadas extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $empleado_name;

    public $proyecto;

    public $tot_horas_proyecto;

    public $horas_asignadas;

    public function __construct($empleado_name, $proyecto, $tot_horas_proyecto, $horas_asignadas)
    {
        $this->empleado_name = $empleado_name;
        $this->proyecto = $proyecto;
        $this->tot_horas_proyecto = $tot_horas_proyecto;
        $this->horas_asignadas = $horas_asignadas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.timesheet.timesheet_horas_sobrepasadas')
            ->subject('Timesheet - Notificacion de Horas Sobrepasadas para proyecto:' . $this->proyecto);
    }
}
