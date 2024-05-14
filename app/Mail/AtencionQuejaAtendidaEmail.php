<?php

namespace App\Mail;

use App\Models\QuejasCliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AtencionQuejaAtendidaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $quejas;

    public function __construct(QuejasCliente $quejas)
    {
        $this->quejas = $quejas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.quejasCliente.atencion-queja')->subject('La queja con folio '.$this->quejas->folio.' esta siendo atendida');
    }
}
