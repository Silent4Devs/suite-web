<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmpleadoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empleado)
    {
        $this->empleado = $empleado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.empleados')
            ->with([
                'nombre' => $this->empleado->name,
                'email' => $this->empleado->email,
                'img_twitter' => $this->getBase64(asset('img/twitter.png')),
                'img_linkedin' => $this->getBase64(asset('img/linkedin.png')),
                'img_facebook' => $this->getBase64(asset('img/facebook.png')),
                'img_requi' => $this->getBase64(asset('img/img_req.png')),
            ]);
    }
}