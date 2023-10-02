<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use Livewire\Component;
use App\Models\Escuela\Requirement;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseRequirements extends Component
{
    use LivewireAlert, AuthorizesRequests;

    public Requirement $requirement;
    public $course, $name;

    protected $rules = [
        'requirement.name' => 'required',
    ];

    protected $messages = [
        'requirement.name.required' => 'El campo nombre es obligatorio',
        'requirement.name.max' => 'El campo nombre es obligatorio'
    ];

    public function mount($course)
    {
        $this->course = $course;
        $this->requirement = new Requirement();
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-requirements');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.max' => 'El campo nombre no debe ser mayor a 255 caracteres'
        ]);

        $this->course->requirements()->create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Requisito añadida exitosamente');
    }

    public function edit(Requirement $requirement)
    {
        $this->requirement = $requirement;
    }

    public function update()
    {
        $this->validate();

        $this->requirement->save();

        $this->requirement = new Requirement();

        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Requisito actualizada exitosamente');
    }

    public function destroy(Requirement $requirement)
    {
        $requirement->delete();
        $this->course = Course::find($this->course->id);
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
