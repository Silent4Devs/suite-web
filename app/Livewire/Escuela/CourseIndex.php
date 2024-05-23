<?php

namespace App\Livewire\Escuela;

use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Level;
use Livewire\Component;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    // Añadí el use WithPagination para que cada que cambie de página unicamente se haga el cambio de cursos, en caso de no añadirse
    // se regarga la página completa cuando se cambie el número de página.
    use WithPagination;

    public $category_id;

    public $level_id;

    public $selectioncategory;

    public $selectionlevel;

    public function render()
    {
        // dd("test");
        $categories = Category::all();
        $levels = Level::all();
        $courses = Course::where('status', 3)
            ->category($this->category_id)
            ->level($this->level_id)
            ->latest('id')->paginate(8);

        foreach ($courses as $course) {
            $courses_lessons = $course->lessons;
            $lesson_introduction = $courses_lessons->first();
            // dump($courses_lessons->first());
            if (! is_null($lesson_introduction)) {
                if (is_null($lesson_introduction['iframe'])) {
                    $course->lesson_introduction = null;
                } else {
                    $course->lesson_introduction = $lesson_introduction['iframe'];
                }
            } else {
                $course->lesson_introduction = null;
            }

        }

        return view('livewire.escuela.course-index', compact('courses', 'categories', 'levels'));
    }

    public function resetFilters()
    {
        $this->reset(['category_id', 'level_id']);
    }

    public function categoryFilter()
    {
        // dd($this->selection);
        if ($this->selectioncategory === 0) {
            $this->resetFilters();
        } else {
            $this->category_id = $this->selectioncategory;
        }
    }

    public function levelFilter()
    {
        if ($this->selectionlevel === 0) {
            $this->resetFilters();
        } else {
            $this->level_id = $this->selectionlevel;
        }
    }
}
