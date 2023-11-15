<?php

namespace App\Http\Livewire\Escuela;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\UserEvaluation;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CourseStatus extends Component
{
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
        //Evaluaciones para el curso en general
        $this->evaluacionesGenerales = Evaluation::where('course_id', $this->course->id)->get();
        $this->evaluationsUser = UserEvaluation::where('user_id', User::getCurrentUser()->id)->where('completed', true)->pluck('evaluation_id')->toArray();

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
        return view('livewire.escuela.course-status');
    }

    //METODOS
    //cambiamos la lección actual
    public function changeLesson(Lesson $lesson)
    {
        $this->current = $lesson;
        // dd($this->current);
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
        $this->course = Course::find($this->course->id);
    }

    //PROPIEDADES COMPUTADAS
    //definimos la propiedad index, lo que va hacer es calcular el indice
    public function getIndexProperty()
    {
        // Recupere todas las lecciones de un curso
        // El metodo pluck me recupera una coleccion a traves de una coleccion ya existente
        return $this->course->lessons->pluck('id')->search($this->current->id);
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

    public function download()
    {
        // dd($this->current->resource);
        return response()->download(storage_path('app/'.$this->current->resource->url));
    }
}
