<?php

namespace App\Livewire\Escuela;

use App\Models\Escuela\Course;
use App\Models\Escuela\UsuariosCursos;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EstudiantesCrear extends Component
{
    use LivewireAlert;

    public $user_id;

    public $usuarios;

    public $course;

    public $open = false;

    protected $rules = [
        'user_id' => 'required',
    ];

    protected $messages = [
        'user_id.required' => 'Debe seleccionar un usuario',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function save()
    {
        $this->validate();
        UsuariosCursos::create([
            'user_id' => $this->user_id,
            'course_id' => $this->course->id,
        ]);
        // $this->open = false;
        $this->dispatch('UserStore');
        $this->render_alerta('success', 'El estudiante se ha agregado exitosamente');
        $this->dispatch('closeModal');
    }

    public function render_alerta($type, $message)
    {
        $this->alert($type, $message, [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        $usuariosInscritos = UsuariosCursos::with('usuarios')->where('course_id', $this->course->id)->pluck('user_id')->toArray();

        $this->usuarios = User::whereNotIn('id', $usuariosInscritos)->orderBy('name')->get();

        return view('livewire.escuela.estudiantes-crear', ['usuarios' => $this->usuarios]);
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }

    public function cancel()
    {
        $this->user_id = null;
    }
}
