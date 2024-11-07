<?php

namespace App\Livewire\Escuela\Instructor;

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

    public $order;

    protected $rules = [
        'section.name' => 'required',
        'name' => 'required',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->section = new Section;
    }

    public function render()
    {
        // $this->dispatch('renderJS');
        $this->dispatch('renderJS');

        return view('livewire.escuela.instructor.courses-curriculum')->with('course', $this->course);

    }

    public function store()
    {
        // dump($this->course->sections);
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
        // dd(Course::getAll()->find($this->course->id));
        $this->course = Course::find($this->course->id);
        $this->render_alerta('success', 'Registro añadido exitosamente');
        // dd($this->course->sections);
    }

    public function edit(Section $section)
    {
        $this->section = $section;
        $this->name = $section->name;
    }

    public function update()
    {
        // $this->validate();
        $this->validateOnly('name');

        // dd($this->name);
        $this->section->name = $this->name;
        // dd($this->section);
        $this->section->save();
        $this->section = new Section;

        // $this->course = Course::getAll()->find($this->course->id);
        $this->render_alerta('success', 'Registro actualizado exitosamente');
    }

    public function destroy(Section $section)
    {
        // dump($section);
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

    public function updatedOrder($value)
    {
        // dd($value);
        $this->order = $value;

        $this->course->update([
            'order_section' => $this->order,
        ]);

        // dump($this->course->order_section);
    }
}
