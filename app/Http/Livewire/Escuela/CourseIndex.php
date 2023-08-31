<?php

namespace App\Http\Livewire\Escuela;

use Livewire\Component;

use App\Models\escuela\Course;
use App\Models\escuela\Category;
use App\Models\escuela\Level;

use Livewire\WithPagination;

class CourseIndex extends Component
{
    // Añadí el use WithPagination para que cada que cambie de página unicamente se haga el cambio de cursos, en caso de no añadirse
    // se regarga la página completa cuando se cambie el número de página.
    use WithPagination;

    public $category_id;
    public $level_id;

    public function render()
    {
        // dd("test");
        $categories = Category::all();
        $levels = Level::all();
        $courses = Course::where('status', 3)
            ->category($this->category_id)
            ->level($this->level_id)
            ->latest('id')->paginate(8);
        return view('livewire.escuela.course-index', compact('courses', 'categories', 'levels'));
    }

    public function resetFilters()
    {
        $this->reset(['category_id', 'level_id']);
    }
}
