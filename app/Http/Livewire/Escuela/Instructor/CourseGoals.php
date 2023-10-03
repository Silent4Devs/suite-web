<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Goal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseGoals extends Component
{
    use LivewireAlert, AuthorizesRequests;

    public Goal $goal;
    public $course;
    public $name;

    protected $rules = [
        'goal.name' => 'required|max:255',
    ];

    protected $messages = [
        'goal.name.required' => 'El campo nombre es obligatorio',
        'goal.name.max' => 'El campo nombre es obligatorio'
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
            'name' => 'required|max:255',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.max' => 'El campo nombre no debe ser mayor a 255 caracteres'
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
        $this->validate($this->rules, $this->messages);

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
