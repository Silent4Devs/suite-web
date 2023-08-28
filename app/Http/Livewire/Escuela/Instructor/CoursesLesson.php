<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Lesson;
use App\Models\Escuela\Platform;
use App\Models\Escuela\Section;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class CoursesLesson extends Component
{
    use LivewireAlert;

    public $section, $lesson, $platforms, $name, $platform_id = 1, $url;

    protected $rules = [
        'lesson.name' => 'required',
        'lesson.platform_id' => 'required',
        'lesson.url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x'],
    ];

    public function mount(Section $section) {
        $this->section = $section;
        // dd($this->section->id);
        $this->lesson = new Lesson();

        $this->platforms = Platform::all();
    }

    public function render() {
        return view('livewire.escuela.instructor.courses-lesson');
    }

    public function store() {
        $rules = [
            'name' => 'required',
            'platform_id' => 'required',
            'url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x'],
        ];

        if ($this->platform_id == 2) {
            $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate($rules);
        Lesson::create([
            'name' => $this->name,
            'platform_id' => $this->platform_id,
            'url' => $this->url,
            'section_id' => $this->section->id,
        ]);

        $this->reset('name', 'platform_id', 'url');
        $this->section = Section::find($this->section->id);
        // $this->render_alerta('success', 'Registro añadido exitosamente');

    }

    public function edit(Lesson $lesson) {
        $this->resetValidation();
        $this->lesson = $lesson;
    }

    public function update() {
        if ($this->lesson->platform_id == 2) {
            $this->rules['lesson.url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate();

        $this->lesson->save();
        $this->lesson = new Lesson();

        $this->section = Section::find($this->section->id);
        $this->render_alerta('success', 'Registro actualizado exitosamente');

    }

    public function cancel() {
        $this->lesson = new Lesson();
        $this->resetValidation();
        $this->reset('name', 'platform_id', 'url');
    }

    public function destroy(Lesson $lesson) {
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
