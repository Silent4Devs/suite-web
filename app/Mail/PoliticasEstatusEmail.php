<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PoliticasEstatusEmail extends Mailable
{
    use Queueable, SerializesModels;

<<<<<<< HEAD
    public $empleado_name;
=======
    public $id_politica;
>>>>>>> origin/release/experiencia_usuario_s3

    public $comite_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //prueba
<<<<<<< HEAD
    public function __construct()
    {
=======
    public function __construct($id_politica)
    {
        $this->id_politica = $id_politica;
>>>>>>> origin/release/experiencia_usuario_s3
    }

    public function getBase64($url)
    {
        try {
            $img_route = $url;
            $logo_base = file_get_contents($img_route);
<<<<<<< HEAD
            $img = 'data:image/png;base64,'.base64_encode($logo_base);
=======
            $img = 'data:image/png;base64,' . base64_encode($logo_base);
>>>>>>> origin/release/experiencia_usuario_s3

            return $img;
        } catch (\Exception $e) {
            try {
                $img_route = $url;
                $logo_base = Storage::get($img_route);
<<<<<<< HEAD
                $img = 'data:image/png;base64,'.base64_encode($logo_base);

                return $img;
            } catch (\Throwable $th) {
                $img = 'data:image/png;base64,'.'';
=======
                $img = 'data:image/png;base64,' . base64_encode($logo_base);

                return $img;
            } catch (\Throwable $th) {
                $img = 'data:image/png;base64,' . '';
>>>>>>> origin/release/experiencia_usuario_s3

                return $img;
            }
        }
    }

    // app/Mail/NombreDelCorreo.php
    public function build()
    {
        return $this->view('emails.politicas_estatus', [
            'img_twitter' => $this->getBase64(asset('img/twitter.png')),
            'img_linkedin' => $this->getBase64(asset('img/linkedin.png')),
            'img_facebook' => $this->getBase64(asset('img/facebook.png')),
            'img_requi' => $this->getBase64(asset('img/img_req.png')),
        ]);
    }
}
