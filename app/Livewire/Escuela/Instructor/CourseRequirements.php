<?php

namespace App\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Requirement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CourseRequirements extends Component
{
    use AuthorizesRequests, LivewireAlert;

    public Requirement $requirement;

    public $course;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('max:255', message: 'El campo debe ser menor a 255 caracteres')]
    public $formName;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('max:255', message: 'El campo debe ser menor a 255 caracteres')]
    public $name;

    public function mount($course)
    {
        $this->course = $course;
        $this->requirement = new Requirement;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-requirements');
    }

    public function store()
    {
        $this->validateOnly('name');

        $this->course->requirements()->create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Requisito añadida exitosamente');
    }

    public function edit(Requirement $requirement)
    {
        $this->requirement = $requirement;
        $this->formName = $requirement->name;
    }

    public function update()
    {
        $this->validateOnly('formName');

        $this->requirement->name = $this->formName;

        $this->requirement->save();

        $this->requirement = new Requirement;

        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Requisito actualizada exitosamente');
    }

    public function destroy(Requirement $requirement)
    {
        $requirement->delete();
        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Requisito eliminada exitosamente');
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
