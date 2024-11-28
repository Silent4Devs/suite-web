<?php

namespace App\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\Platform;
use App\Models\Escuela\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CoursesLesson extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $section;

    public $lesson;

    public $platforms;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('max:255', message: 'El campo debe ser menor a 255 caracteres')]
    public $name;

    #[Validate('required', message: 'El campo es requerido')]
    public $platform_id = 1;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x')]
    public $url;

    public $description;

    public $file;

    public $openElementId;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('max:255', message: 'El campo debe ser menor a 255 caracteres')]
    public $formName;

    #[Validate('required', message: 'El campo es requerido')]
    public $formPlatformId = 1;

    #[Validate('required', message: 'El campo es requerido')]
    #[Validate('regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x')]
    public $formUrl;

    protected $listeners = ['closeCollapse'];

    // protected $rules = [
    //     'lesson.name' => 'required',
    //     'lesson.platform_id' => 'required',
    //     'lesson.url' => ['regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
    // ];

    public function mount(Section $section)
    {
        $this->section = $section;
        // $this->lesson = new Lesson;
    }

    public function render()
    {
        $this->platforms = Platform::get();
        // dd($this->lesson);

        return view('livewire.escuela.instructor.courses-lesson');
    }

    public function store()
    {
        // $rules = [
        //     'name' => 'required',
        //     'platform_id' => 'required',
        //     'url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
        //     // 'file' => 'required',
        // ];

        try {
            $this->validateOnly('name');
            $this->validateOnly('platform_id');
            $this->validateOnly('url');
            //code...
            if ($this->platform_id == 2) {
                $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
            }

            // $this->validate($rules);

            $resource = Lesson::create([
                'name' => $this->name,
                'platform_id' => $this->platform_id,
                'url' => $this->url.'?rel=0',
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
        } catch (\Throwable $th) {
            // dd('error');
            $this->render_alerta('error', 'Completa los campos obligatorios');
            //throw $th;
        }


    }

    public function edit(Lesson $lesson)
    {

        $this->resetValidation();
        $this->lesson = $lesson;
        // dd($lesson->name);
        $this->formName = $lesson->name;
        $this->formPlatformId = $lesson->platform_id;
        $this->formUrl = $lesson->url;

    }

    public function update()
    {
        // dd($this->lesson);
        // $rules = [
        //     'lesson.name' => 'required',
        //     'platform_id' => 'required',
        //     'url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
        //     // 'file' => 'required',
        // ];
        try {
            //code...
            $this->validateOnly('formName');
            $this->validateOnly('formPlatformId');
            $this->validateOnly('formUrl');

            if ($this->lesson->platform_id == 2) {
                $this->rules['lesson.url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
            }

            $this->lesson->name = $this->formName;
            $this->lesson->platform_id = $this->formPlatformId;
            $this->lesson->url = $this->formUrl;

            $this->lesson->save();
            if ($this->file) {
                $urlresorce = $this->file->store('cursos');
                $this->lesson->resource()->create([
                    'url' => $urlresorce.'?rel=0',
                ]);
            }
            // $this->lesson = new Lesson();

            $this->section = Section::find($this->section->id);
            $this->render_alerta('success', 'Registro actualizado exitosamente');
            // redirect()->route('admin.courses.edit', $this->course);
        } catch (\Throwable $th) {
            //throw $th;
            $this->render_alerta('error', 'Completa los campos obligatorios');

        }
    }

    public function cancel()
    {
        $this->lesson = new Lesson;
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



    public function closeCollapse()
    {
        $this->openElementId = null;
    }
}
