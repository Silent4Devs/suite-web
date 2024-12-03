<?php

namespace App\Notifications;

use App\Models\ContractManager\Requsicion;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequisicionesNotification extends Notification
{
    use Queueable;

    public $requsicion;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Requsicion $requsicion, $tipo_consulta, $tabla, $slug)
    {
        $this->requsicion = $requsicion;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->requsicion->id,
            'updated_at' => $this->requsicion->updated_at,
            'deleted_at' => $this->requsicion->deleted_at,
            'time' => Carbon::now(),
            'type' => $this->tipo_consulta,
            'tabla' => $this->tabla,
            'slug' => $this->slug,
        ];
    }
}
