<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Audience;
use App\Models\Escuela\Course;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CourseAudiences extends Component
{
    use AuthorizesRequests, LivewireAlert;

    public Audience $audience;

    public $course;

    public $name;

    protected $rules = [
        'audience.name' => 'required|max:255',
    ];

    protected $messages = [
        'audience.name.required' => 'El campo nombre es obligatorio',
        'audience.name.max' => 'El campo nombre es obligatorio',
    ];

    public function mount($course)
    {
        $this->course = $course;
        $this->audience = new Audience();
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-audiences');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.max' => 'El campo nombre no debe ser mayor a 255 caracteres',
        ]);

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
    }

    public function update()
    {
        $this->validate();

        $this->audience->save();

        $this->audience = new Audience();

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
