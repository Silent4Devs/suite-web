<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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

    public function getBase64($url)
    {
        try {
            $img_route = $url;
            $logo_base = file_get_contents($img_route);
            $img = 'data:image/png;base64,' . base64_encode($logo_base);

            return $img;
        } catch (\Exception $e) {
            try {
                $img_route = $url;
                $logo_base = Storage::get($img_route);
                $img = 'data:image/png;base64,' . base64_encode($logo_base);

                return $img;
            } catch (\Throwable $th) {
                $img = 'data:image/png;base64,' . '';

                return $img;
            }
        }
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