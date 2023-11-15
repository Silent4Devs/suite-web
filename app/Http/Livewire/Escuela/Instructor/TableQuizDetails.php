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

    protected $listeners = ['render'];

    public function mount($course_id)
    {
        // dd($course_id);
        $this->course = Course::find($course_id);
        $this->evaluations = Evaluation::where('course_id', $course_id)->get();
        $this->students = $this->course->students;
    }

    public function render()
    {
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
