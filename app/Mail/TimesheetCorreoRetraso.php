<?php

namespace App\Mail;

use App\Models\Empleado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimesheetCorreoRetraso extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $times_faltantes_empleado = [];

    public $empleado;

    public function __construct(Empleado $empleado, $times_faltantes_empleado)
    {
        $this->times_faltantes_empleado = $times_faltantes_empleado;
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_QARECEPTOR'), 'Tabantaj')->
                    view('mails.timesheet.timesheet_correo_retraso');
    }
}
