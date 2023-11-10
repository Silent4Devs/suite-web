<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CoursesCurriculum extends Component
{
    use LivewireAlert;

    public $course;

    public $section;

    public $name;

    protected $rules = [
        'section.name' => 'required',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->section = new Section();
    }

    public function render()
    {
        return view('livewire.escuela.instructor.courses-curriculum')->with('course', $this->course);
    }

    public function store()
    {
        // dd($this->course);
        $count = Section::where('course_id', '=', $this->course->id)->count();
        // dd($count);
        // $this->validate([
        //     'name' => 'required'
        // ]);
        if ($count == 0) {
            Section::create([
                'name' => 'Seccion 1',
                'course_id' => $this->course->id,
            ]);
        } else {
            $count = $count + 1;
            Section::create([
                'name' => 'Seccion '.$count,
                'course_id' => $this->course->id,
            ]);
        }

        // Section::create([
        //     'name'          => $this->name,
        //     'course_id'     => $this->course->id,
        // ]);

        // $this->reset('name');
        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Registro añadido exitosamente');
    }

    public function edit(Section $section)
    {
        $this->section = $section;
    }

    public function update()
    {
        $this->validate();

        $this->section->save();
        $this->section = new Section();

        $this->course = Course::find($this->course->id);
        // $this->render_alerta('success', 'Registro actualizado exitosamente');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Registro eliminado exitosamente');
    }

    public function resetName()
    {
        $this->reset('name');
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
