<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificatesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $certificate_id;

    public $name;

    public function __construct($certificate_id, $name)
    {
        $this->name = $name;
        $this->certificate_id = $certificate_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.certificates.notification-certificates-participates')->subject('Solicitud Aprobación de certificación: '.$this->name);
    }
}
