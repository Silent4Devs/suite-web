<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectionNotificationCertificatesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id;

    public $catalogueTraining;

    public function __construct($id, $catalogueTraining)
    {
        $this->id = $id;
        $this->catalogueTraining = $catalogueTraining;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.certificates.rejection-notification-certificates')->subject('Nombre de Certificación Rechazado: '.$this->catalogueTraining->name);
    }
}
