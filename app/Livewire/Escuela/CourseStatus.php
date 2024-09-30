<?php

namespace App\Livewire\Escuela;

use App\Models\Escuela\Course;
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

    public $lecciones_orden;

    public $usuario;

    public $fecha;

    public $hora;

    public $render;

    //metodo mount se carga una unica vez y esto sucede cuando se carga la página
    public function mount($course, $evaluacionesLeccion)
    {
        // dd($course);
        $this->evaluacionesGenerales = $evaluacionesLeccion;

        $this->usuario = User::getCurrentUser();
        $this->fecha = Carbon::now()->toDateString();
        $this->hora = Carbon::now()->format('H:i:s');
        // $this->lecciones_orden = collect();
        $this->course = $course;
        // dd($course->sections);
        $this->current = $course->last_finished_lesson;
        $this->lecciones_orden = $this->course->sections_order;
        // dd($this->current);
        //determinamos cual es la lección actual

        // dd($this->current->iframe);
        // $this->authorize('enrolled', $course);
    }

    public function render()
    {
        // dd($this->course);
        // dd($this->course->lessons->where('completed', true)->count());
        // dd($this->current);
        // $fechaYHora = $this->fecha.' '.$this->hora;
        // $cursoLastReview = UsuariosCursos::where('course_id', $this->course->id)
        //     ->where('user_id', $this->usuario->id)->first();
        // dd($cursoLastReview);

        // $this->updateLastReview($fechaYHora, $cursoLastReview);

        //Evaluaciones para el curso en general
        $this->evaluationsUser = UserEvaluation::where('user_id', $this->usuario->id)->where('completed', true)->pluck('evaluation_id')->toArray();

        //dd($this->course);

        // dd($this->current);

        // foreach ($this->course->sections_order as $secciones_lecciones) {
        //     dump($secciones_lecciones);
        //     foreach ($secciones_lecciones->lessons as $lesson) {
        //         dump($lesson);
        //         if (! $lesson->completed) {
        //             // dd($lesson);
        //             $this->current = $lesson;
        //             //break para que salga del bucle
        //             dd($this->current);
        //             break;
        //         }
        //     }
        //     if ($this->current) {
        //         // dd($lesson);
        //         //break para que salga del bucle
        //         break;
        //     }
        // }

        // En caso de que ya hayan sido culminadas todas las lecciones en la propiedas current se le va asignar la ultima lección
        if (! $this->current) {
            $this->current = $this->course->lessons->last();
        }
        // else{
        //     $this->current = $this->course->lastfinishedlesson;
        // }

        return view('livewire.escuela.course-status');
    }

    //METODOS
    //cambiamos la lección actual
    public function changeLesson(Lesson $lesson, $atras = null)
    {
        // Verificar si el usuario está yendo a una lección anterior o desea regresar
        if ($atras == 'previous') {
            $this->current = $lesson;
            $this->dispatch('render'); // Renderizar la vista correctamente

            return;
        }

        // Permitir acceder a la lección seleccionada si está completada
        if ($lesson->completed) {
            $this->current = $lesson;
            $this->dispatch('render');

            return;
        }

        // Si la lección actual no está completada, bloquear el acceso a la nueva lección
        if (! $this->current->completed) {
            $this->alertaEmergente('Es necesario terminar esta lección antes de avanzar.');
            $this->dispatch('render'); // Asegurarse de renderizar la lección actual

            return;
        }

        // Si la lección actual está completada y la nueva lección no está bloqueada, permitir el acceso
        $this->current = $lesson;
        $this->dispatch('completado'); // Despachar evento para lecciones completadas
        $this->dispatch('render'); // Renderizar la nueva vista
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
        if ($this->course && $this->lecciones_orden && $this->current) {
            // Use optional() to safely access 'id' property of each lesson and search for $this->current->id

            $lecciones_ordenadas = collect();

            foreach ($this->course->sections_order as $secciones_lecciones) {
                foreach ($secciones_lecciones->lessons as $lesson) {
                    $lecciones_ordenadas->push($lesson);
                }
            }
            $this->lecciones_orden = $lecciones_ordenadas;

            return optional($lecciones_ordenadas->pluck('id'))->search($this->current->id);
        }

        return null; // or handle the situation based on your logic
    }

    //calculamos la propiedad previous
    public function getPreviousProperty()
    {
        if ($this->index == 0) {
            return null;
        } else {
            return $this->lecciones_orden[$this->index - 1];
        }
    }

    //propiedad next
    public function getNextProperty()
    {
        if ($this->index == $this->lecciones_orden->count() - 1) {
            return null;
        } else {
            return $this->lecciones_orden[$this->index + 1];
        }
    }

    public function getAdvanceProperty()
    {
        $i = 0;

        foreach ($this->lecciones_orden as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        //calcular el porcentaje de la
        $advance = ($i * 100) / ($this->lecciones_orden->count());

        return round($advance, 2);
    }

    public function getSectionAdvanceProperty()
    {
        $i = 0;

        foreach ($this->lecciones_orden as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        //calcular el porcentaje de la
        $advance = ($i * 100) / ($this->lecciones_orden->count());

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

    public function test(Lesson $lesson)
    {
        // dump($this->current);
        $this->current = $lesson;
        // dump($this->current);
    }
}
