<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Evaluation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationsTable extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $course;

    protected $listeners = ['evaluationStore' => 'render'];

    public function mount($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.evaluations-table', [
            'evaluaciones' => Evaluation::where('course_id', $this->course->id)->orWhereIn('section_id', $this->course->lessons->pluck('id')->toArray())->paginate(10)
        ]);
    }

    public function destroy($evaluacion_id)
    {

        $evaluaciones = Evaluation::find($evaluacion_id)->delete();
        $this->render_alerta('success', 'El registro fue eliminado exitosamente');
        $this->emit('evaluationStore');
        $this->emit('evaluationDestroy');
    }

    public function edit($evaluacion_id)
    {
        $evaluacion = Evaluation::find($evaluacion_id);
        $this->emit('editarEvaluacion', $evaluacion);
    }

    public function render_alerta($type, $message)
    {
        $this->alert($type, $message, [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
}
