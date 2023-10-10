<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
// use App\Traits\RenderizarAlerta;
use Livewire\Component;
use Livewire\WithPagination;

class TableQuestions extends Component
{
    // use RenderizarAlerta;
    use WithPagination;

    public $course;
    public $evaluation;
    protected $listeners = ['QuestionEvent' => 'render', 'questionStore' => 'render', 'destroyQuestion' => 'destroy'];

    public function mount(Course $course, Evaluation $evaluation)
    {
        $this->course = $course;
        $this->getEvaluation($evaluation);
    }

    public function getEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.table-questions')->with('course', $this->course)->with('evaluation', $this->evaluation);
        // return view("admin.escuela.instructor.test");
    }

    public function destroy($question_id)
    {
        // dd($question_id);
        $question = Question::find($question_id);
        //si lo agregas el delete() a lado me retorna un booleano  por eso se coloca
        //de la siguiente forma porque tengo que acceder al modelo y después a answer
        $question->delete();
        foreach ($question->answers as $answer) {
            $answer->delete();
        }

        $this->emit('QuestionEvent');
        // $this->render_alerta('success','El registro fue eliminado exitosamente');
    }
}
