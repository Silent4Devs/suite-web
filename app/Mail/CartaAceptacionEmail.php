<?php

namespace App\Mail;

use App\Models\CartaAceptacion;
use App\Models\Empleado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartaAceptacionEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $carta;

    public $empleado;

    public function __construct(Empleado $empleado, CartaAceptacion $carta)
    {
        $this->carta = $carta;
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.carta.solicitud');
    }
}
