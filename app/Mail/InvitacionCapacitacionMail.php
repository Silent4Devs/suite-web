<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitacionCapacitacionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.capacitaciones.invitacion-capacitacion');
    }
}
