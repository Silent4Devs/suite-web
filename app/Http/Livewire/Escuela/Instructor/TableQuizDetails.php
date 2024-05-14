<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use Livewire\Component;

class TableQuizDetails extends Component
{
    public $course;

    public $students;

    public $evaluations;

    public $evaluation = null;

    public $evaluation_id;

    public $user_id;

    public $user;

    public $course_id;

    protected $listeners = ['render'];

    public function mount($course_id)
    {
        // $this->students = $this->course->students;
        $this->course_id = $course_id;
    }

    public function render()
    {
        $this->course = Course::getAll()->find($this->course_id);
        $this->evaluations = Evaluation::where('course_id', $this->course_id)->get();
        $this->students = $this->course->students;
        // $students = $this->course->students()->where('name', 'LIKE', "%{$this->search}%")->get();

        return view('livewire.escuela.instructor.table-quiz-details');
    }

    public function findEvaluation()
    {
        $this->evaluation = $this->evaluation_id;
        $this->user = $this->user_id;
        // $this->emit('renderQuizDetail',[
        //     'evaluation'=>$this->evaluation,
        //     'course'=>$this->course,
        //     'user'=>$this->user,
        // ]);
    }
}
