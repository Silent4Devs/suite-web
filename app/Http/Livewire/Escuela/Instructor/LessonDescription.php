<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Lesson;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LessonDescription extends Component
{
    use LivewireAlert;

    public $lesson;
    public $description;
    public $name;

    protected function rules()
    {
        if ($this->description) {
            return[
                'description.name' => 'required',
            ];
        } else {
            return[
                'name' => 'required',
            ];
        }
    }

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;

        if ($lesson->description) {
            $this->description = $lesson->description;
        }
    }

    public function render()
    {
        return view('livewire.escuela.instructor.lesson-description');
    }

    public function store()
    {
        $this->description = $this->lesson->description()->create(['name' => $this->name]);
        $this->reset('name');
        $this->lesson = Lesson::find($this->lesson->id);
        $this->render_alerta('success', 'Registro añadido exitosamente');
    }

    public function update()
    {
        $this->validate();
        $this->description->save();
        $this->render_alerta('success', 'Registro actualizado exitosamente');
    }

    public function destroy()
    {
        $this->description->delete();
        $this->reset('description');
        $this->lesson = Lesson::find($this->lesson->id);
        $this->render_alerta('success', 'Registro eliminado exitosamente');
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
