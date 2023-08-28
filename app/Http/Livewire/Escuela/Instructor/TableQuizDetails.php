<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Course;
use App\Models\Evaluation;
use App\Models\UserEvaluation;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TableQuizDetails extends Component
{
    public $course;
    public $students;
    public $evaluations;
    public $evaluation = null;
    public $evaluation_id;
    public $user_id;
    public $user;
    protected $listeners=['render'];
    public function mount(Course $course)
    {
       $this->course = $course;
       $this->evaluations = Evaluation::where('course_id',$this->course->id)->get();
       $this->students=$this->course->students;
    }

    public function render()
    {
        // $students = $this->course->students()->where('name', 'LIKE', "%{$this->search}%")->get();


        return view('livewire.instructor.table-quiz-details');
    }

    public function findEvaluation()
    {
        $this->evaluation = $this->evaluation_id;
        $this->user=$this->user_id;
        // $this->emit('renderQuizDetail',[
        //     'evaluation'=>$this->evaluation,
        //     'course'=>$this->course,
        //     'user'=>$this->user,
        // ]);
    }

}
