<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectionNotificationCertificatesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id;

    public $catalogueTraining;

    public $comment;

    public function __construct($id, $catalogueTraining, $comment)
    {
        $this->id = $id;
        $this->catalogueTraining = $catalogueTraining;
        $this->comment = $comment;
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
