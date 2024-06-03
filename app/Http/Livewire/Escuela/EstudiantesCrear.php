<?php

namespace App\Http\Livewire\Escuela;

use App\Models\Area;
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

    public $publico;

    public $area;

    public $area_seleccionada;

    protected $rules = [
        'user_id' => 'required',
    ];

    protected $messages = [
        'user_id.required' => 'Debe seleccionar un usuario',
    ];

    public function updatedPublico($value)
    {
        $this->publico = $value;
    }

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function save()
    {

        if ($this->publico == 'todos') {
            foreach ($this->usuarios as $usuario) {
                UsuariosCursos::create([
                    'user_id' => $usuario->id,
                    'course_id' => $this->course->id,
                ]);
                $this->emit('UserStore');
            }
            $this->render_alerta('success', 'Los estudiantes de la organización se han agregado exitosamente');
            $this->dispatchBrowserEvent('closeModal');
        }

        if ($this->publico == 'area') {
            foreach ($this->usuarios as $usuario) {
                if(isset($usuario->empleado->area_id)){
                    if ($usuario->empleado->area_id == $this->area_seleccionada) {
                        UsuariosCursos::create([
                            'user_id' => $usuario->id,
                            'course_id' => $this->course->id,
                        ]);
                    }
                    $this->emit('UserStore');
                }
            }
            $this->render_alerta('success', 'Los estudiantes del área '.Area::where('id', $this->area_seleccionada)->first()->area.' se han agregado exitosamente');
            $this->dispatchBrowserEvent('closeModal');
        }

        if ($this->publico == 'manual') {
            $this->validate();
            UsuariosCursos::create([
                'user_id' => $this->user_id,
                'course_id' => $this->course->id,
            ]);
            // $this->open = false;
            $this->emit('UserStore');
            $this->render_alerta('success', 'El estudiante se ha agregado exitosamente');
            $this->dispatchBrowserEvent('closeModal');
        }
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

        if ($this->publico == 'area') {
            $this->areas = Area::get();
        }

        return view('livewire.escuela.estudiantes-crear', ['usuarios' => $this->usuarios]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function cancel()
    {
        $this->user_id = null;
    }
}
