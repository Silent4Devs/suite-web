<?php

namespace App\Livewire\Escuela;

use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Level;
use Livewire\Component;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    // se regarga la página completa cuando se cambie el número de página.
    use WithPagination;

    public $category_id;

    protected $queryString = ['page'];

    public $level_id;

    public $selectioncategory;

    public $selectionlevel;

    public $page = 1;

    public function render()
    {

        $categories = Category::getAll();
        $levels = Level::getAll();
        $courses = Course::where('status', 3)
            ->category($this->category_id)
            ->level($this->level_id)
            ->latest('id')->paginate(6);

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
                //            foreach ($courses as $course){
        //     dump($course->id, $course->title);
        //     // dump($course->instructor->name);
        //     dump($course->user);
        // }
        // dd('stop');


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
