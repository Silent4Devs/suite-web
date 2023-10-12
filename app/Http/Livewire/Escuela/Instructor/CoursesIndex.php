<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CoursesIndex extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $courses = Course::where('title', 'LIKE', "%{$this->search}%")->where('user_id', User::getCurrentUser()->id)->latest('id')->paginate(10);

        return view('livewire.escuela.instructor.courses-index', compact('courses'));
    }

    public function limpiar_page()
    {
        $this->reset('page');
    }
}
