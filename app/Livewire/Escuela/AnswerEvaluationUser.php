<?php

namespace App\Livewire\Escuela;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
use App\Models\Escuela\Instructor\UserAnswer;
use App\Models\Escuela\UserEvaluation;
use App\Models\User;
use Carbon\Carbon;
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

    public $percentage;

    public $correctQuestions;

    public $percentageEvaluationUser;

    public $course_id;

    public $evaluacion_id;

    public $showRetry = false;

    public $retry = false;

    public $attempt_count = null;

    public $answeredQuestionsretry = [];

    public $last_score = null;

    public $tiempoRestante;

    protected $listeners = ['contadorReintentos'];

    protected $rules = [
        'answer' => 'required',
    ];

    protected $messages = [
        'answer.required' => 'La respuesta es obligatoria',
    ];

    public function mount($course_id, $evaluacion_id)
    {

        $this->course_id = $course_id;
        $this->evaluacion_id = $evaluacion_id;
    }

    public function getNextQuestion()
    {
        if ($this->retry) {
            //Return a random question from the section selected by the user for quiz.
            // disabled because having issues with shuffle, it works but in a wierd way.

            // dd($this->answeredQuestionsretry);

            $question = Question::where('evaluation_id', $this->evaluation->id)
                ->whereIn('id', $this->answeredQuestionsretry)
                ->with('answers')
                ->inRandomOrder()
                ->first();

            //If the quiz size is greater then actual questions available in the quiz sections,
            //Finish the quiz and take the user to results page on exhausting all question from a given section.
            if ($question === null) {

                $this->retry = false;

                $this->correctQuestions = UserAnswer::Questions($this->evaluation->id)->where('is_correct', true)->count();
                $totalQuestions = $this->totalQuizQuestions == 0 ? 1 : $this->totalQuizQuestions;
                $this->percentage = ($this->correctQuestions * 100) / $totalQuestions;

                //Update quiz size to curret count as we have ran out of quesitons and forcing user to end the quiz ;)
                $this->userEvaluationId->quiz_size = $this->count - 1;
                $this->userEvaluationId->completed = true;

                if (($this->userEvaluationId->score < $this->percentage)) {
                    $this->userEvaluationId->score = $this->percentage;
                }

                $this->userEvaluationId->quiz_size = $this->totalQuizQuestions;
                $this->userEvaluationId->number_of_attempts = $this->userEvaluationId->number_of_attempts - 1;
                $this->userEvaluationId->last_attempt = Carbon::now();
                $this->userEvaluationId->save();

                return $this->showResults();
            }

            //Update the questions taken array so that we don't repeat same question again in the quiz
            //We feed this array into whereNotIn chain in getNextquestion() function.
            array_push($this->answeredQuestions, $question->id);

            return $question;
        } else {
            //Return a random question from the section selected by the user for quiz.
            // disabled because having issues with shuffle, it works but in a wierd way.
            // dd("aqui");

            $this->answeredQuestions = UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', User::getCurrentUser()->id)->pluck('question_id')->toArray();

            $question = Question::where('evaluation_id', $this->evaluation->id)
                ->whereNotIn('id', $this->answeredQuestions)
                ->with('answers')
                ->inRandomOrder()
                ->first();

            //If the quiz size is greater then actual questions available in the quiz sections,
            //Finish the quiz and take the user to results page on exhausting all question from a given section.
            if ($question === null) {
                $this->correctQuestions = UserAnswer::Questions($this->evaluation->id)->where('is_correct', true)->count();
                $totalQuestions = $this->totalQuizQuestions == 0 ? 1 : $this->totalQuizQuestions;
                $this->percentage = ($this->correctQuestions * 100) / $totalQuestions;
                //Update quiz size to curret count as we have ran out of quesitons and forcing user to end the quiz ;)
                $this->userEvaluationId->quiz_size = $this->count - 1;
                $this->userEvaluationId->completed = true;

                if (($this->userEvaluationId->score < $this->percentage)) {
                    $this->userEvaluationId->score = $this->percentage;
                }

                $this->userEvaluationId->quiz_size = $this->totalQuizQuestions;
                $this->userEvaluationId->number_of_attempts = $this->userEvaluationId->number_of_attempts - 1;
                $this->userEvaluationId->last_attempt = Carbon::now();
                $this->userEvaluationId->save();

                return $this->showResults();
            }
            //Update the questions taken array so that we don't repeat same question again in the quiz
            //We feed this array into whereNotIn chain in getNextquestion() function.
            array_push($this->answeredQuestions, $question->id);

            return $question;
        }
    }

    public function startQuiz()
    {
        // dd($this->evaluation);
        // Create a new quiz header in quiz_headers table and populate initial quiz information
        // Keep the instance in $this->quizid veriable for later updates to quiz.
        // $this->validate();
        $userEvaluationExist = UserEvaluation::where('user_id', User::getCurrentUser()->id)->where('evaluation_id', $this->evaluation->id)->exists();

        if (! $userEvaluationExist) {
            $this->userEvaluationId = UserEvaluation::create([
                'user_id' => User::getCurrentUser()->id,
                'quiz_size' => $this->totalQuizQuestions,
                'evaluation_id' => $this->evaluation->id,

            ]);
            $this->count = 1;
            $this->attempt_count = $this->userEvaluationId->number_of_attempts;

            // Get the first/next question for the quiz.
            // Since we are using LiveWire component for quiz, the first quesiton and answers will be displayed through mount function.
            $this->setupQuiz = false;
            $this->quizInProgress = true;
            $this->retry = false;
            $this->currentQuestion = $this->getNextQuestion();
        } else {

            $this->userEvaluationId = UserEvaluation::where('user_id', User::getCurrentUser()->id)->where('evaluation_id', $this->evaluation->id)->first();

            if (($this->userEvaluationId->completed) && ($this->retry) && ($this->attempt_count > 0)) {

                $this->userEvaluationId->update(['completed' => false]);
                $this->attempt_count = $this->userEvaluationId->number_of_attempts;
                $this->count = 1;

                $this->answeredQuestions = UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', User::getCurrentUser()->id)->pluck('question_id')->toArray();
                $this->showResults = false;

                // Get the first/next question for the quiz.
                // Since we are using LiveWire component for quiz, the first quesiton and answers will be displayed through mount function.
                $this->currentQuestion = $this->getNextQuestion();
                $this->setupQuiz = false;
                $this->quizInProgress = true;
            } else {

                $this->count = UserAnswer::Questions($this->evaluation->id)->count() == 0 ? 1 : UserAnswer::Questions($this->evaluation->id)->count();
                $this->attempt_count = $this->userEvaluationId->number_of_attempts;
                // dd($this->userEvaluationId->completed, ($this->userEvaluationId->score != 0), $this->attempt_count > 0);
                if ($this->userEvaluationId->completed && $this->attempt_count > 0) {
                    $this->showRetry = false;
                    $this->retry = false;
                    $this->showResults();
                } elseif ((!$this->userEvaluationId->completed) && ($this->userEvaluationId->score != 0) && ($this->attempt_count > 0)) {
                    $this->retry = true;
                    $this->currentQuestion = $this->getNextQuestion();
                } elseif ((!$this->userEvaluationId->completed) && ($this->userEvaluationId->score == 0) && ($this->attempt_count > 0)) {
                    $this->showRetry = false;
                    $this->showResults = false;
                    $this->retry = false;
                    $this->currentQuestion = $this->getNextQuestion();
                } else {
                    $this->showResults();
                }
            }
        }
    }

    public function showResults()
    {
        $this->showResults = true;
        $this->retry = false;
        $this->correctQuestions = UserAnswer::Questions($this->evaluation->id)->where('is_correct', true)->count();
        $totalQuestions = $this->totalQuizQuestions == 0 ? 1 : $this->totalQuizQuestions;
        $this->percentage = ($this->correctQuestions * 100) / $totalQuestions;
        if ($this->percentage < 100 && ! $this->retry && ($this->attempt_count > 0)) {
            $this->showRetry = true;
        } else {
            $this->showRetry = false;
        }
    }

    public function nextQuestion()
    {
        if ($this->retry) {
            $this->validate();
            // Push all the question ids to quiz_header table to retreve them while displaying the quiz details
            $this->questionsTaken = UserAnswer::Questions($this->evaluation->id)->get();
            $choicesCorrect = Answer::where('question_id', $this->currentQuestion->id)->where('is_correct', true)->pluck('id')->toArray();
            $isChoiceCorrect = in_array($this->answer, $choicesCorrect);

            // Insert the current question_id, answer_id and whether it is correnct or wrong to quiz table.
            UserAnswer::updateOrCreate([
                'user_id' => User::getCurrentUser()->id,
                'evaluation_id' => $this->evaluation->id,
                'user_evaluation_id' => $this->userEvaluationId->id,
                'question_id' => $this->currentQuestion->id,
            ], [
                'answer_id' => $this->answer,
                'is_correct' => $isChoiceCorrect,
            ]);

            // Reset the veriables for next question
            $choicesCorrect = '';
            $isChoiceCorrect = '';
            $this->answer = null;
            $this->reset('userAnswered');
            //   $this->isDisabled = true;

            $this->answeredQuestionsretry = array_diff($this->answeredQuestionsretry, [$this->currentQuestion->id]);

            // Get a random question
            $this->currentQuestion = $this->getNextQuestion();
        } else {
            $this->validate();
            // Push all the question ids to quiz_header table to retreve them while displaying the quiz details
            $this->questionsTaken = UserAnswer::Questions($this->evaluation->id)->get();
            $choicesCorrect = Answer::where('question_id', $this->currentQuestion->id)->where('is_correct', true)->pluck('id')->toArray();
            $isChoiceCorrect = in_array($this->answer, $choicesCorrect);
            // Insert the current question_id, answer_id and whether it is correnct or wrong to quiz table.
            UserAnswer::create([
                'user_id' => User::getCurrentUser()->id,
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
    }

    public function getEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function retryEvaluation()
    {
        if ($this->attempt_count >= 0) {

            $this->retry = true;

            $this->answeredQuestionsretry = UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', User::getCurrentUser()->id)->pluck('question_id')->toArray();

            $this->count = $this->totalQuizQuestions - UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', User::getCurrentUser()->id)->count();

            $this->startQuiz();
        } else {
            dd('mensaje error');
        }
    }

    public function updateContador()
    {
        $time_now = Carbon::now()->toDateTimeString();

        // $this->userEvaluationId
        $lastAttempt = Carbon::parse($this->userEvaluationId->last_attempt);
        $now = Carbon::now();

        // Calcular el tiempo restante para el próximo intento
        $diferencia = $now->diffInSeconds($lastAttempt->addHours(8), false);

        // $retry->number_of_attempts = 3;
        // $retry->save();

        if ($diferencia < 0) {
            // Si ha pasado el tiempo, restablecer los intentos
            $this->userEvaluationId->number_of_attempts = 3;
            $this->userEvaluationId->save();
            $this->attempt_count = $this->userEvaluationId->number_of_attempts;
            $this->tiempoRestante = 'Intentos restablecidos.';
        } else {
            // Formatear el tiempo restante
            $horas = floor($diferencia / 3600);
            $minutos = floor(($diferencia % 3600) / 60);
            $segundos = $diferencia % 60;

            $this->tiempoRestante = sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);
        }
    }

    public function render()
    {
        $this->course = Course::getAll()->find($this->course_id);
        $evaluation = Evaluation::find($this->evaluacion_id);
        $this->getEvaluation($evaluation);
        $this->totalQuizQuestions = count($this->evaluation->questions);
        $this->startQuiz();
        // dump($this->retry);
        // dd($this->userEvaluationId->score, $this->percentage, ($this->userEvaluationId->score < $this->percentage));
        if (! $this->retry) {
            // dd(1);
            $this->answeredQuestions = UserAnswer::where('evaluation_id', $this->evaluation->id)->where('user_id', User::getCurrentUser()->id)->pluck('question_id')->toArray();

            $this->count = count($this->answeredQuestions) + 1;
        } else {
            // dd(2);
            $this->count = ($this->totalQuizQuestions + 1) - count($this->answeredQuestionsretry);
        }
        // dd(3);
        return view('livewire.escuela.answer-evaluation-user');
    }
}
