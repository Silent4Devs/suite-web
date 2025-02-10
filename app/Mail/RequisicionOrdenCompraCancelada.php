<?php

namespace App\Mail;

use App\Models\FirmasRequisiciones;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RequisicionOrdenCompraCancelada extends Mailable
{
    use Queueable, SerializesModels;

    public $requsicion;

    public $organizacion;

    public $tipo;

    public $supervisor;

    public $puesto;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    // prueba
    public function __construct($requsicion, $organizacion, $tipo)
    {
        $this->requsicion = $requsicion;
        $this->organizacion = $organizacion;
        $this->tipo = $tipo;

        $firmas = FirmasRequisiciones::where('requisicion_id', $requsicion->id)->first();

        $user = User::where('id', $this->requsicion->id_user)->first();

        $empleado = $user->empleado;
    }

    public function getBase64($url)
    {
        try {
            $img_route = $url;
            $logo_base = file_get_contents($img_route);
            $img = 'data:image/png;base64,'.base64_encode($logo_base);

            return $img;
        } catch (\Exception $e) {
            try {
                $img_route = $url;
                $logo_base = Storage::get($img_route);
                $img = 'data:image/png;base64,'.base64_encode($logo_base);

                return $img;
            } catch (\Throwable $th) {
                $img = 'data:image/png;base64,'.'';

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
        return $this->from(env('MAIL_QARECEPTOR'), 'Sender Name')
            ->view('emails.requisicionCancelada', [
                'requisicion' => $this->requsicion,
                'organizacion' => $this->organizacion,
                'tipo' => $this->tipo,

                'logo' => $this->getBase64($this->organizacion->logo),
                'img_twitter' => $this->getBase64(asset('img/twitter.png')),
                'img_linkedin' => $this->getBase64(asset('img/linkedin.png')),
                'img_facebook' => $this->getBase64(asset('img/facebook.png')),
                'img_requi' => $this->getBase64(asset('img/img_req.png')),
            ]);
    }
}
