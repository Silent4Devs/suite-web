<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Requirement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CourseRequirements extends Component
{
    use LivewireAlert, AuthorizesRequests;

    public Requirement $requirement;
    public $course;
    public $name;

    protected $rules = [
        'requirement.name' => 'required',
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
            'name' => 'required',
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
