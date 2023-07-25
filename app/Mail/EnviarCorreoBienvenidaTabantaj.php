<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarCorreoBienvenidaTabantaj extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;

    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empleado, $password)
    {
        $this->empleado = $empleado;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.bienvenida.bienvenida', [
            'empleado' => $this->empleado,
            'password' => $this->password,
        ])->subject('Bienvenido a Tabantaj');
    }
}
