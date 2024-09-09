<?php

namespace App\Livewire\Escuela;

use App\Models\Area;
use App\Models\Empleado;
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

    public $usuarios_manual;

    public $areas;

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
        $this->usuarios_manual = collect();
        // $this->usuarios = collect();

    }

    public function save()
    {

        if ($this->publico == 'todos') {
            foreach ($this->usuarios as $usuario) {
                // dump(is_null($usuario->empleado));
                if (! is_null($usuario->empleado) && $usuario->empleado->estatus === 'alta') {
                    UsuariosCursos::create([
                        'user_id' => $usuario->id,
                        'course_id' => $this->course->id,
                    ]);
                    $this->dispatch('UserStore');
                }
            }
            $this->render_alerta('success', 'Los estudiantes de la organización se han agregado exitosamente');
            $this->dispatch('closeModal');
        }

        if ($this->publico == 'area') {
            foreach ($this->usuarios as $usuario) {
                if (isset($usuario->empleado->area_id) && $usuario->empleado->estatus === 'alta') {
                    if ($usuario->empleado->area_id == $this->area_seleccionada) {
                        UsuariosCursos::create([
                            'user_id' => $usuario->id,
                            'course_id' => $this->course->id,
                        ]);
                    }
                    $this->dispatch('UserStore');
                }
            }
            $this->render_alerta('success', 'Los estudiantes del área '.Area::where('id', $this->area_seleccionada)->first()->area.' se han agregado exitosamente');
            $this->dispatch('closeModal');
        }

        if ($this->publico == 'manual') {
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

        $usuarios = User::whereNotIn('id', $usuariosInscritos)->orderBy('name')->get();

        $empleados = Empleado::where('estatus', 'alta')->get();

        foreach ($usuarios as $usuario) {
            foreach ($empleados as $empleado) {
                if ($empleado->id === $usuario->empleado_id) {

                    $this->usuarios_manual->push($usuario);
                }
            }
        }
        $this->usuarios = $usuarios;

        // dd($this->usuarios[0]->empleado);

        if ($this->publico == 'area') {
            $this->areas = Area::getAll();
        }

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
