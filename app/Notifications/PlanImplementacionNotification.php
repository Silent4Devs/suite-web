<?php

namespace App\Notifications;

use App\Models\PlanImplementacion;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PlanImplementacionNotification extends Notification
{
    use Queueable;

    public $plan;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PlanImplementacion $plan, $tipo_consulta, $tabla, $slug)
    {
        $this->plan = $plan;
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
            'id' => $this->plan->id,
            'updated_at' => $this->plan->updated_at,
            'deleted_at' => $this->plan->deleted_at,
            'time' => Carbon::now(),
            'type' => $this->tipo_consulta,
            'tabla' => $this->tabla,
            'slug' => $this->slug,
            // 'name' => Auth::user()->name,
            // 'avatar_ruta' => Auth::user()->empleado->avatar_ruta,
        ];
    }
}
