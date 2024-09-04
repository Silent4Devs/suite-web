<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct() {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.certificates.certificates-reminder')->subject('Recordatorio de Certificaciones');
    }
}
