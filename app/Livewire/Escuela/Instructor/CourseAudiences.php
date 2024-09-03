<?php

namespace App\Livewire\Escuela\Instructor;

use App\Models\Escuela\Audience;
use App\Models\Escuela\Course;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CourseAudiences extends Component
{
    use AuthorizesRequests, LivewireAlert;

    public Audience $audience;

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
        $this->audience = new Audience;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-audiences');
    }

    public function store()
    {
        $this->validateOnly('name');

        $this->course->audiences()->create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Audiencia añadida exitosamente');
    }

    public function edit(Audience $audience)
    {
        $this->audience = $audience;
        $this->formName = $audience->name;
    }

    public function update()
    {
        $this->validateOnly('formName');

        $this->audience->name = $this->formName;

        $this->audience->save();

        $this->audience = new Audience;

        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Audiencia actualizada exitosamente');
    }

    public function destroy(Audience $audience)
    {
        $audience->delete();
        $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Audiencia eliminada exitosamente');
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
