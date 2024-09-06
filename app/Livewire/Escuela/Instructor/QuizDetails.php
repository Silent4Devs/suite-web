<?php

namespace App\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\UserAnswer;
use App\Models\Escuela\UserEvaluation;
use App\Models\User;
use Livewire\Component;

class QuizDetails extends Component
{
    public $evaluationUser;

    public $course;

    public $totalQuestions;

    public $percentageEvaluationUser;

    public $correctQuestions;

    public $evaluation;

    public $totalQuizQuestions;

    public $alphabet;

    public $userAnswers;

    public $user;

    protected $listeners = ['renderQuizDetail' => 'getQuizDetail'];

    public function mount(Evaluation $evaluation, Course $course, ?User $user)
    {
        // dd($course, $evaluation, $user);
        $this->getQuizDetail($evaluation, $course, $user);
    }

    public function getQuizDetail(Evaluation $evaluation, Course $course, User $user)
    {
        $this->alphabet = range('A', 'Z');
        $evaluation->load('section');
        $this->evaluation = $evaluation;
        $this->course = $course;
        $this->user = $user;
    }

    public function render()
    {
        $this->totalQuizQuestions = count($this->evaluation->questions);
        $this->evaluationUser = UserEvaluation::where('evaluation_id', $this->evaluation->id)->where('user_id', $this->user->id != null ? $this->user->id : auth()->id())->first();
        $this->correctQuestions = UserAnswer::Questions($this->evaluation->id, $this->user->id != null ? $this->user->id : null)->where('is_correct', true)->count();
        $this->totalQuestions = $this->totalQuizQuestions == 0 ? 1 : $this->totalQuizQuestions;
        $this->percentageEvaluationUser = ($this->correctQuestions * 100) / $this->totalQuestions;
        $this->userAnswers = UserAnswer::Questions($this->evaluation->id, $this->user->id != null ? $this->user->id : null)->with('question', 'answer')->get();

        return view('livewire.escuela.instructor.quiz-details');
    }
}
