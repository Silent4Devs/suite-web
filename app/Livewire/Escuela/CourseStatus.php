<?php

namespace App\Livewire\Escuela;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\UserEvaluation;
use App\Models\Escuela\UsuariosCursos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CourseStatus extends Component
{
    use LivewireAlert;

    // use AuthorizesRequests;
    //declaramos la propiedad course y current
    public $course;

    public $current;

    public $evaluacionesGenerales;

    public $evaluacionesLeccion;

    public $evaluationsUser;

    //metodo mount se carga una unica vez y esto sucede cuando se carga la página
    public function mount(Course $course, $evaluacionesLeccion)
    {
        $this->course = $course;
        //determinamos cual es la lección actual
        foreach ($course->lessons as $lesson) {
            if (! $lesson->completed) {
                $this->current = $lesson;
                //break para que salga del bucle
                break;
            }
        }

        // En caso de que ya hayan sido culminadas todas las lecciones en la propiedas current se le va asignar la ultima lección
        if (! $this->current) {
            $this->current = $course->lessons->last();
        }

        // dd($this->current->iframe);
        // $this->authorize('enrolled', $course);
    }

    public function render()
    {
        $usuario = User::getCurrentUser();
        $fecha = Carbon::now()->toDateString();
        $hora = Carbon::now()->format('H:i:s');
        $fechaYHora = $fecha.' '.$hora;
        $cursoLastReview = UsuariosCursos::where('course_id', $this->course->id)
            ->where('user_id', $usuario->id)->first();
        // dd($cursoLastReview);

        $this->updateLastReview($fechaYHora, $cursoLastReview);

        //Evaluaciones para el curso en general
        $this->evaluacionesGenerales = Evaluation::where('course_id', $this->course->id)->get();
        $this->evaluationsUser = UserEvaluation::where('user_id', User::getCurrentUser()->id)->where('completed', true)->pluck('evaluation_id')->toArray();

        //dd($this->course);

        return view('livewire.escuela.course-status');
    }

    //METODOS
    //cambiamos la lección actual
    public function changeLesson(Lesson $lesson, $atras = null)
    {
        if ($atras == 'previous') {
            $this->current = $lesson;

            return;
        }

        if ($this->current->completed) {
            $this->current = $lesson;

            return;
        }

        if (! $this->current->completed) {
            $this->alertaEmergente('Es necesario terminar esta lección para poder seguir avanzando en tu curso');

            return;
        }

        //$this->current = $lesson;
    }

    public function completed()
    {
        $usuario = User::getCurrentUser();
        if ($this->current->completed) {
            //Eliminar registro
            // Metodo auth me recupera el dato del usuario autentificado
            $this->current->users()->detach($usuario->id);
        } else {
            //Agregar registro
            $this->current->users()->attach($usuario->id);
        }
        $this->current = Lesson::find($this->current->id);
        $this->course = Course::getAll()->find($this->course->id);
    }

    //PROPIEDADES COMPUTADAS
    //definimos la propiedad index, lo que va hacer es calcular el indice
    public function getIndexProperty()
    {
        // Check if $this->course exists and is not null
        if ($this->course && $this->course->lessons) {
            // Use optional() to safely access 'id' property of each lesson and search for $this->current->id
            return optional($this->course->lessons->pluck('id'))->search($this->current->id);
        }

        return null; // or handle the situation based on your logic
    }

    //calculamos la propiedad previous
    public function getPreviousProperty()
    {
        if ($this->index == 0) {
            return null;
        } else {
            return $this->course->lessons[$this->index - 1];
        }
    }

    //propiedad next
    public function getNextProperty()
    {
        if ($this->index == $this->course->lessons->count() - 1) {
            return null;
        } else {
            return $this->course->lessons[$this->index + 1];
        }
    }

    public function getAdvanceProperty()
    {
        $i = 0;

        foreach ($this->course->lessons as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        //calcular el porcentaje de la
        $advance = ($i * 100) / ($this->course->lessons->count());

        return round($advance, 2);
    }

    public function getSectionAdvanceProperty()
    {
        $i = 0;

        foreach ($this->course->lessons as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        //calcular el porcentaje de la
        $advance = ($i * 100) / ($this->course->lessons->count());

        return round($advance, 2);
    }

    public function download()
    {
        // dd($this->current->resource);
        return response()->download(storage_path('app/'.$this->current->resource->url));
    }

    public function alertSection()
    {
        $this->alertaEmergente('Es necesario terminar esta sección para poder seguir avanzando en tu curso');
    }

    public function alertaEmergente($message)
    {
        $this->alert('warning', $message, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function updateLastReview($time, $cursoLastReview)
    {
        $cursoLastReview->update([
            'last_review' => $time,
        ]);
    }
}
