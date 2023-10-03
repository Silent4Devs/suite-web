<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RequisicionesEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $requisicion;
    public $organizacion;
    public $tipo_firma;
    public $tipo_firma_siguiente;
    public $supervisor;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //prueba
    public function __construct($nueva_requisicion, $organizacion, $tipo_firma)
    {
        $this->requisicion = $nueva_requisicion;
        $this->organizacion = $organizacion;
        $this->tipo_firma = $tipo_firma;

        $this->supervisor = User::getCurrentUser()->empleado->supervisor->name;

        // requisiciones
        if ($tipo_firma === 'firma_solicitante') {
            $this->tipo_firma_siguiente = 'firma_jefe';
        }
        if ($tipo_firma === 'firma_jefe') {
            $this->tipo_firma_siguiente = 'firma_finanzas';
        }
        if ($tipo_firma === 'firma_finanzas') {
            $this->tipo_firma_siguiente = 'firma_compras';
        }
        if ($tipo_firma === 'firma_compras') {
            $this->tipo_firma_siguiente = 'firma_solicitante';
        }
        if ($tipo_firma === 'rechazado_requisicion') {
            $this->tipo_firma_siguiente = 'requisicion_rechazado';
        }

        // ordenes de compra
        if ($tipo_firma === 'firma_comprador_orden') {
            $this->tipo_firma_siguiente = 'firma_solicitante_orden';
        }
        if ($tipo_firma === 'firma_solicitante_orden') {
            $this->tipo_firma_siguiente = 'firma_finanzas_orden';
        }
        if ($tipo_firma === 'firma_finanzas_orden') {
            $this->tipo_firma_siguiente = 'firma_solicitante_orden_finalizado';
        }
        if ($tipo_firma === 'rechazado') {
            $this->tipo_firma_siguiente = 'orden_rechazado';
        }
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
        return $this->from(env('MAIL_QARECEPTOR'), 'Sender Name')
            ->view('emails.requisiciones', [
                'supervisor' =>  $this->supervisor,
                'requisicion' => $this->requisicion,
                'organizacion' => $this->organizacion,
                'tipo_firma' => $this->tipo_firma,
                'tipo_firma_siguiente' => $this->tipo_firma_siguiente,

                'logo' => $this->getBase64($this->organizacion->logotipo),
                'img_twitter' => $this->getBase64(asset('img/twitter.png')),
                'img_linkedin' => $this->getBase64(asset('img/linkedin.png')),
                'img_facebook' => $this->getBase64(asset('img/facebook.png')),
                'img_requi' => $this->getBase64(asset('img/img_req.png')),
            ]);
    }
}
