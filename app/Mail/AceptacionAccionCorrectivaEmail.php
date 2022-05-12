<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\QuejasCliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AceptacionAccionCorrectivaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $quejas;
    public $evidencia;

    public function __construct(QuejasCliente $quejas, $evidencia=[])
    {
        $this->quejas = $quejas;
        $this->evidencia=$evidencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('mails.accioncorrectiva.aceptacion');
        foreach ($this->evidencia as $evidencia){
            $this->attach(public_path("storage/evidencias_quejas_clientes/{$evidencia}"));
        }

        return $this;
    }
}
