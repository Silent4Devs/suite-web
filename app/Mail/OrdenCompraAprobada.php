<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class OrdenCompraAprobada extends Mailable
{
    use Queueable, SerializesModels;

    public $requisicion;

    public $organizacion;

    public $tipo;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    // prueba
    public function __construct($nueva_requisicion, $organizacion, $tipo)
    {
        $this->requisicion = $nueva_requisicion;
        $this->organizacion = $organizacion;
        $this->tipo = $tipo;
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
        return $this->view('emails.ordenCompraCompletada', [
            'requisicion' => $this->requisicion,
            'organizacion' => $this->organizacion,

            'logo' => $this->getBase64($this->organizacion->logotipo),
            'img_twitter' => $this->getBase64(asset('img/twitter.png')),
            'img_linkedin' => $this->getBase64(asset('img/linkedin.png')),
            'img_facebook' => $this->getBase64(asset('img/facebook.png')),
            'img_requi' => $this->getBase64(asset('img/img_req.png')),
        ])->subject('Orden de Compra ('.$this->tipo.') Aprobada: '.$this->requisicion->referencia);
    }
}
