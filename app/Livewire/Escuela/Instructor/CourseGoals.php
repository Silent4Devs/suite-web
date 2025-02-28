<?php

namespace App\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Goal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CourseGoals extends Component
{
    use AuthorizesRequests, LivewireAlert;

    public Goal $goal;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('max:255', message: 'El campo debe ser menor a 255 caracteres')]
    public $formName;

    public $course;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('max:255', message: 'El campo debe ser menor a 255 caracteres')]
    public $name;

    public function mount($course)
    {
        $this->course = $course;
        $this->goal = new Goal;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-goals');
    }

    public function store()
    {
        $this->validateOnly('name');

        $this->course->goals()->create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Meta añadida exitosamente');
    }

    public function edit(Goal $goal)
    {
        $this->goal = $goal;
        $this->formName = $goal->name;
    }

    public function update()
    {
        $this->validateOnly('formName');

        $this->goal->name = $this->formName;

        $this->goal->save();

        $this->goal = new Goal;

        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Meta actualizada exitosamente');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Meta eliminada exitosamente');
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
