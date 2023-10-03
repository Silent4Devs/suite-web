<?php

namespace App\Http\Livewire\Escuela;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
use App\Models\Escuela\Instructor\UserAnswer;
use App\Models\Escuela\UserEvaluation;
use Livewire\Component;

class AnswerEvaluationUser extends Component
{
    public $answer;
    public $userEvaluationId;
    public $course;
    public $evaluation;
    public $currentQuestion;
    public $count = 0;
    public $totalQuizQuestions;
    public $setupQuiz = true;
    public $userAnswered = [];
    public $isDisabled = true;
    public $currectQuizAnswers;
    public $learningMode = false;
    public $quizInProgress = false;
    public $answeredQuestions = [];
    public $questionsTaken;
    public $showResults = false;
    public $quizPercentage;
    public $correctQuestions;
    public $percentageEvaluationUser;

    protected $rules = [
        'answer' => 'required',
    ];

    protected $messages = [
        'answer.required' => 'La respuesta es obligatoria',
    ];

    public function mount($course_id, $evaluacion_id)
    {
        $this->course = Course::find($course_id);
        $evaluation = Evaluation::find($evaluacion_id);
        $this->getEvaluation($evaluation);
        $this->totalQuizQuestions = count($this->evaluation->questions);
        $this->startQuiz();
        $this->answeredQuestions = UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', auth()->id())->pluck('question_id')->toArray();
        $this->count = count($this->answeredQuestions) + 1;
    }

    public function getNextQuestion()
    {
        //Return a random question from the section selected by the user for quiz.
        // disabled because having issues with shuffle, it works but in a wierd way.
        // dd("aqui");

        $this->answeredQuestions = UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', auth()->id())->pluck('question_id')->toArray();

        $question = Question::where('evaluation_id', $this->evaluation->id)
            ->whereNotIn('id', $this->answeredQuestions)
            ->with('answers')
            ->inRandomOrder()
            ->first();

        //If the quiz size is greater then actual questions available in the quiz sections,
        //Finish the quiz and take the user to results page on exhausting all question from a given section.
        if ($question === null) {
            //Update quiz size to curret count as we have ran out of quesitons and forcing user to end the quiz ;)
            $this->userEvaluationId->quiz_size = $this->count - 1;
            $this->userEvaluationId->completed = true;
            $this->userEvaluationId->save();

            return $this->showResults();
        }
        //Update the questions taken array so that we don't repeat same question again in the quiz
        //We feed this array into whereNotIn chain in getNextquestion() function.
        array_push($this->answeredQuestions, $question->id);

        return $question;
    }

    public function startQuiz()
    {
        // dd($this->evaluation);
        // Create a new quiz header in quiz_headers table and populate initial quiz information
        // Keep the instance in $this->quizid veriable for later updates to quiz.
        // $this->validate();
        $userEvaluationExist = UserEvaluation::where('user_id', auth()->id())->where('evaluation_id', $this->evaluation->id)->exists();
        if (!$userEvaluationExist) {
            $this->userEvaluationId = UserEvaluation::create([
                'user_id' => auth()->id(),
                'quiz_size' => $this->totalQuizQuestions,
                'evaluation_id' => $this->evaluation->id,

            ]);
            $this->count = 1;
        } else {
            $this->userEvaluationId = UserEvaluation::where('user_id', auth()->id())->where('evaluation_id', $this->evaluation->id)->first();
            $this->count = UserAnswer::Questions($this->evaluation->id)->count() == 0 ? 1 : UserAnswer::Questions($this->evaluation->id)->count();
            if ($this->userEvaluationId->completed) {
                $this->showResults();
            }
        }

        // Get the first/next question for the quiz.
        // Since we are using LiveWire component for quiz, the first quesiton and answers will be displayed through mount function.
        $this->currentQuestion = $this->getNextQuestion();
        $this->setupQuiz = false;
        $this->quizInProgress = true;
    }

    public function showResults()
    {
        $this->showResults = true;
        $this->correctQuestions = UserAnswer::Questions($this->evaluation->id)->where('is_correct', true)->count();
        $totalQuestions = $this->totalQuizQuestions == 0 ? 1 : $this->totalQuizQuestions;
        $this->percentage = ($this->correctQuestions * 100) / $totalQuestions;
    }

    public function nextQuestion()
    {
        $this->validate();
        // Push all the question ids to quiz_header table to retreve them while displaying the quiz details
        $this->questionsTaken = UserAnswer::Questions($this->evaluation->id)->get();
        $choicesCorrect = Answer::where('question_id', $this->currentQuestion->id)->where('is_correct', true)->pluck('id')->toArray();
        $isChoiceCorrect = in_array($this->answer, $choicesCorrect);
        // dd($isChoiceCorrect);
        // Insert the current question_id, answer_id and whether it is correnct or wrong to quiz table.
        UserAnswer::create([
            'user_id' => auth()->id(),
            'user_evaluation_id' => $this->userEvaluationId->id,
            'answer_id' => $this->answer,
            'is_correct' => $isChoiceCorrect,
            'evaluation_id' => $this->evaluation->id,
            'question_id' => $this->currentQuestion->id,
        ]);

        // Increment the quiz counter so we terminate the quiz on the number of question user has selected during quiz creation.
        $this->count++;

        // Reset the veriables for next question
        $choicesCorrect = '';
        $isChoiceCorrect = '';
        $this->answer = null;
        $this->reset('userAnswered');
        //   $this->isDisabled = true;

        // Finish the quiz when user has successfully taken all question in the quiz.
        if ($this->count == $this->totalQuizQuestions + 1) {
            //   $this->showResults();
        }

        // Get a random questoin
        $this->currentQuestion = $this->getNextQuestion();
    }

    public function getEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function render()
    {
        return view('livewire.escuela.answer-evaluation-user');
    }
}
