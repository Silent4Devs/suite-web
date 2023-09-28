<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Goal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CourseGoals extends Component
{
    use LivewireAlert, AuthorizesRequests;

    public Goal $goal;
    public $course;
    public $name;

    protected $rules = [
        'goal.name' => 'required',
    ];

    public function mount($course)
    {
        $this->course = $course;
        $this->goal = new Goal();
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-goals');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $this->course->goals()->create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Meta añadida exitosamente');
    }

    public function edit(Goal $goal)
    {
        $this->goal = $goal;
    }

    public function update()
    {
        $this->validate();

        $this->goal->save();

        $this->goal = new Goal();

        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Meta actualizada exitosamente');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        $this->course = Course::find($this->course->id);
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
