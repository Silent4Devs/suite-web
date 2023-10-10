<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\UsuariosCursos;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
// use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;

class CoursesStudents extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $course;
    public $search;
    public $listeners = ['UserStore'=>'render'];

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        $students = $this->course->students()->where('name', 'LIKE', "%{$this->search}%")->paginate(10);

        return view('livewire.escuela.instructor.courses-students', compact('students'))->with('course', $this->course);
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

    public function destroy($student)
    {
        $cursoUsuario = UsuariosCursos::where('course_id', $this->course->id)->where('user_id', $student)->first();
        $cursoUsuario->delete();
        $this->render_alerta('success', 'El estudiante fue eliminado exitosamente');
        $this->emit('UserStore');
    }
}
