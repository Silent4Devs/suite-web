<?php

namespace App\Http\Livewire\Escuela;
use App\Models\User;
use App\Models\Escuela\Course;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Escuela\UsuariosCursos;

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
        'user_id.required'=>'Debe seleccionar un usuario'
    ];
    public function mount(Course $course)
    {
        $this->course = $course;

    }

    public function save(){
        $this->validate();
        UsuariosCursos::create([
            'user_id' => $this->user_id,
            'course_id' => $this->course->id,
        ]);
        $this->open=false;
        $this->emit('UserStore');
        $this->render_alerta('success','El estudiante se ha agregado exitosamente');

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
        $usuariosInscritos=UsuariosCursos::with('usuarios')->where('course_id',$this->course->id)->pluck('user_id')->toArray();

        $this->usuarios = User::whereNotIn('id',$usuariosInscritos)->orderBy('name')->get();
        return view('livewire.escuela.estudiantes-crear',['usuarios'=> $this->usuarios]);
    }



    public function hydrate()
    {
        $this->emit('select2');
    }

}
