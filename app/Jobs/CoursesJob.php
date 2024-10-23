<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CoursesNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class CoursesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $courses;

    protected $tipo_consulta;

    protected $tabla;

    protected $slug;

    public function __construct($courses, $tipo_consulta, $tabla, $slug)
    {
        $this->courses = $courses;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        User::select(['users.id', 'users.name', 'users.email', 'role_user.role_id'])
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '=', '1')->where('users.id', '!=', auth()->id())
            ->get()
            ->each(function (User $user) {
                Notification::send($user, new CoursesNotification($this->courses, $this->tipo_consulta, $this->tabla, $this->slug));
            });
    }
}
