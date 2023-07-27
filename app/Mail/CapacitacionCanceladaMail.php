<?php

namespace App\Mail;

use App\Models\Empleado;
use App\Models\Recurso;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CapacitacionCanceladaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recurso;

    public $empleado;

    public function __construct(Recurso $recurso, Empleado $empleado)
    {
        $this->recurso = $recurso;
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.capacitaciones.capacitacion-cancelado', [
            'recurso' => $this->recurso,
            'empleado' => $this->empleado,
        ]);
    }
}
