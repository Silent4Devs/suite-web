<?php

namespace App\Notifications;

use App\Models\Escuela\Course;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CoursesNotification extends Notification
{
    use Queueable;

    public $courses;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Course $courses, $tipo_consulta, $tabla, $slug)
    {
        $this->courses = $courses;
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
            'id' => $this->courses->id,
            'updated_at' => $this->courses->updated_at,
            'deleted_at' => $this->courses->deleted_at,
            'time' => Carbon::now(),
            'type' => $this->tipo_consulta,
            'tabla' => $this->tabla,
            'slug' => $this->slug,
            'name' => Auth::user()->name,
            'avatar_ruta' => Auth::user()->empleado->avatar_ruta,
        ];
    }
}
