<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\Platform;
use App\Models\Escuela\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CoursesLesson extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $section;

    public $lesson;

    public $platforms;

    public $name;

    public $platform_id = 1;

    public $url;

    public $description;

    public $file;

    protected $rules = [
        'lesson.name' => 'required',
        'lesson.platform_id' => 'required',
        'lesson.url' => ['regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
    ];

    public function mount(Section $section)
    {
        $this->section = $section;
        $this->lesson = new Lesson();
        $this->platforms = Platform::get();
    }

    public function render()
    {
        return view('livewire.escuela.instructor.courses-lesson');
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'platform_id' => 'required',
            'url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
            // 'file' => 'required',
        ];

        if ($this->platform_id == 2) {
            $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate($rules);

        // $urlresorce = $this->file->store('cursos');
        // dd($urlresorce);
        $resource = Lesson::create([
            'name' => $this->name,
            'platform_id' => $this->platform_id,
            'url' => $this->url,
            'section_id' => $this->section->id,
            'description' => $this->description,
        ]);

        if ($this->file) {
            $urlresorce = $this->file->store('cursos');
            $resource->resource()->create([
                'url' => $urlresorce,
            ]);
        }

        $this->reset('name', 'platform_id', 'url', 'description', 'file');

        $this->section = Section::find($this->section->id);

        // dd($resource, $this->section->course_id);
        $this->render_alerta('success', 'Registro añadido exitosamente');
    }

    public function edit(Lesson $lesson)
    {
        // dd($this->lesson, $lesson);
        $this->resetValidation();
        $this->lesson = $lesson;
    }

    public function update()
    {
        // dd($this->lesson);
        $rules = [
            'lesson.name' => 'required',
            'platform_id' => 'required',
            'url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
            // 'file' => 'required',
        ];

        if ($this->lesson->platform_id == 2) {
            $this->rules['lesson.url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate($rules);

        $this->lesson->save();
        if ($this->file) {
            $urlresorce = $this->file->store('cursos');
            $this->lesson->resource()->create([
                'url' => $urlresorce,
            ]);
        }
        // $this->lesson = new Lesson();
        $this->section = Section::find($this->section->id);
        $this->render_alerta('success', 'Registro actualizado exitosamente');
        // redirect()->route('admin.courses.edit', $this->course);
    }

    public function cancel()
    {
        $this->lesson = new Lesson();
        $this->resetValidation();
        $this->reset('name', 'platform_id', 'url');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        $this->section = Section::find($this->section->id);
        $this->render_alerta('success', 'Registro eliminado exitosamente');
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
