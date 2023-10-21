<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
use App\Rules\AnswersValidationRule;
// use App\Traits\RenderizarAlerta;
use Illuminate\Support\Collection;
use Livewire\Component;

class Questions extends Component
{
    // use RenderizarAlerta;
    public $open = false;
    public $explanation;
    public $question;
    public $isActive;
    public $evaluation_id;
    public $test;
    public Collection $answers;
    public $questionModel;
    public $edit = false;
    public $onlyIcon = true;
    public $answersDelete = [];
    protected $listeners = [
        'renderQuestion' => 'render',
    ];

    protected function rules()
    {
        return [
            'answers' => 'required',
            'question' => 'required',
            'explanation' => 'nullable',
            'answers.*.answer' => 'required',
            'answers' => [new AnswersValidationRule()],
        ];
    }

    public function mount($evaluation_id, $questionModel = null, $edit = false, $onlyIcon = true)
    {
        $this->fill([
            'answers' => collect([[
                'id' => 0,
                'is_correct' => false,
                'answer' => '',
            ], [
                'id' => 0,
                'is_correct' => false,
                'answer' => '',
            ]]),
        ]);
        $this->evaluation_id = $evaluation_id;
        $this->questionModel = $questionModel;
        $this->edit = $edit;
        $this->onlyIcon = $onlyIcon;

        //edit
        if ($this->edit) {
            $this->explanation = $this->questionModel->explanation;
            $this->question = $this->questionModel->question;
            $answers = $this->questionModel->answers;
            $answersCollect = collect();
            foreach ($answers as $answer) {
                $answersCollect->push([
                    'id' => $answer->id,
                    'is_correct' => $answer->is_correct == '1' ? true : false,
                    'answer' => $answer->answer,
                ]);
            }
            $this->fill([
                'answers' => $answersCollect,
            ]);
        }
    }

    public function removeInput($key)
    {
        $this->answersDelete[] = $this->answers->pull($key);
        $this->answers->pull($key);
    }

    public function addInput()
    {
        $this->answers->push([
            'id' => 0,
            'is_correct' => false,
            'answer' => '',
        ]);
        $this->emit('renderQuestion');
        // dd($this->answers);
    }

    public function render()
    {
        return view('livewire.escuela.instructor.questions');
    }

    public function update($question_id)
    {
        $this->validate();

        $question = Question::find($question_id);
        $question->update([
            'explanation' => $this->explanation,
            'question' => $this->question,
            'evaluation_id' => $this->evaluation_id,
        ]);

        foreach ($this->answers as $answer) {
            $answerExist = Answer::where('id', $answer['id'])->exists();
            if ($answerExist) {
                Answer::find($answer['id'])->update([
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'] == false ? '0' : '1',
                    'question_id' => $question->id,
                ]);
            } else {
                Answer::create([
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'] == false ? '0' : '1',
                    'question_id' => $question->id,
                ]);
            }
        }

        foreach ($this->answersDelete as $answerDelete) {
            $this->Destroy($answerDelete);
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->emit('questionStore');
        $this->open = false;
    }

    // public function destroy($question_id){

    //     $question=Question::find($question_id);
    //     dd($question);
    //     $this->render_alerta('success','El registro fue eliminado exitosamente');
    //     $this->emit('questionStore');

    // }

    public function default($isEdit = false)
    {
        $this->explanation = null;
        $this->question = null;
        $this->fill([
            'answers' => collect([[
                'is_correct' => false,
                'answer' => '',
            ], [
                'is_correct' => false,
                'answer' => '',
            ]]),
        ]);
        //cerra el modal
        $this->open = false;
        $this->edit = false;
    }

    public function cancel()
    {
        $this->edit = true;
        $this->explanation = $this->questionModel->explanation;
        $this->question = $this->questionModel->question;
        $answers = $this->questionModel->answers;
        $answersCollect = collect();
        foreach ($answers as $answer) {
            $answersCollect->push([
                'id' => $answer->id,
                'is_correct' => $answer->is_correct == '1' ? true : false,
                'answer' => $answer->answer,
            ]);
        }
        $this->fill([
            'answers' => $answersCollect,
        ]);
        $this->answersDelete = [];
    }

    public function Destroy($answerDelete)
    {
        $answer = Answer::find($answerDelete['id']);
        if ($answer) {
            $answer->delete();
        }
    }

    public function save()
    {
        $this->validate();
        $question = Question::create([
            'explanation' => $this->explanation,
            'question' => $this->question,
            // 'is_active' => $this->isActive,
            'evaluation_id' => $this->evaluation_id,
        ]);
        foreach ($this->answers as $answer) {
            Answer::create([
                'answer' => $answer['answer'],
                'is_correct' => $answer['is_correct'] == false ? '0' : '1',
                'question_id' => $question->id,
            ]);
        }
        // $this->render_alerta('success', 'El registro se ha agregado exitosamente');
        $this->dispatchBrowserEvent('closeModal');
        $this->emit('questionStore');
        $this->default();
    }
}
