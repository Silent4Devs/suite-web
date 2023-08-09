<?php

namespace App\Http\Livewire\Escuela\Instructor;

use Livewire\Component;
use App\Models\Course;
use Livewire\WithPagination;

class CoursesIndex extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        // $courses = Course::where('title', 'LIKE', "%{$this->search}%")->where('user_id', auth()->user()->id)->latest('id')->paginate(10);


        return view('livewire.escuela.instructor.courses-index');
    }

    public function limpiar_page()
    {
        $this->reset('page');
    }
}
