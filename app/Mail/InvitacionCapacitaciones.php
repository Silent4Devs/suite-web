<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitacionCapacitaciones extends Mailable
{
    use Queueable, SerializesModels;

    protected $capacitacion;

    protected $empleado;

    public function __construct($empleado, $capacitacion)
    {
        $this->empleado = $empleado;
        $this->capacitacion = $capacitacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newarrivals')
            ->subject($this->capacitacion->cursoscapacitaciones)
            ->from('wonderful@company.com', 'Wonderful Company')
            ->with([
                'empleado' => $this->empleado,
                'capacitacion' => $this->capacitacion,
            ]);
    }
}
