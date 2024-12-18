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

    public $content = '';

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

    public $formatType;

    protected $listeners = ['closeCollapse'];

    // protected $rules = [
    //     'lesson.name' => 'required',
    //     'lesson.platform_id' => 'required',
    //     'lesson.url' => ['regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
    // ];

    public function mount(Section $section)
    {
        $this->section = $section;
        $this->platforms = Platform::get();
        // $this->lesson = new Lesson;
        $this->formatType = $this->platformFormat();
    }

    public function render()
    {
        // dd($this->lesson);

        return view('livewire.escuela.instructor.courses-lesson');
    }

    public function platformFormat()
    {
        $platf = Platform::where('id', $this->platform_id)->first();
        return $platf->name;
        //  dd($this->formatType);
    }

    public function updateTypeFormat()
    {
        $this->formatType = $this->platformFormat();
    }

    public function store()
    {
        // $rules = [
        //     'name' => 'required',
        //     'platform_id' => 'required',
        //     'url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x'],
        //     // 'file' => 'required',
        // ];

        // $this->formatType

        switch ($this->formatType) {
            case 'Youtube':
                # code...

                try {
                    $this->validateOnly('name');
                    $this->validateOnly('platform_id');
                    $this->validateOnly('url');

                    $resource = Lesson::create([
                        'name' => $this->name,
                        'platform_id' => $this->platform_id,
                        'url' => $this->url . '?rel=0',
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
                break;

            case 'Vimeo':
                # code...
                try {
                    $this->validateOnly('name');
                    $this->validateOnly('platform_id');
                    $this->validateOnly('url');
                    //code...
                    if ($this->formatType == 'Vimeo') {
                        $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
                    }

                    // $this->validate($rules);

                    $resource = Lesson::create([
                        'name' => $this->name,
                        'platform_id' => $this->platform_id,
                        'url' => $this->url . '?rel=0',
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

                break;

            case 'Texto':
                # code...

                try {
                    $this->validateOnly('name');
                    $this->validateOnly('platform_id');

                    $resource = Lesson::create([
                        'name' => $this->name,
                        'platform_id' => $this->platform_id,
                        'section_id' => $this->section->id,
                        'text_lesson' => $this->description,
                    ]);

                    $this->reset('name', 'platform_id', 'url', 'description', 'file');

                    $this->section = Section::find($this->section->id);

                    // dd($resource, $this->section->course_id);
                    $this->render_alerta('success', 'Registro añadido exitosamente');
                } catch (\Throwable $th) {

                    $this->render_alerta('error', 'Completa los campos obligatorios');
                    //throw $th;
                }
                break;

            case 'Documento':
                # code...

                try {
                    if ($this->file) {
                        $this->validateOnly('name');
                        $this->validateOnly('platform_id');

                        $resource = Lesson::create([
                            'name' => $this->name,
                            'platform_id' => $this->platform_id,
                            'section_id' => $this->section->id,
                        ]);

                        $urlresorce = $this->file->store('cursos/' . 'section/' . $this->section->id . '/lesson' . '/' . $resource->id);

                        $resource->resource()->create([
                            'url' => $urlresorce,
                        ]);

                        $this->reset('name', 'platform_id', 'url', 'description', 'file');

                        $this->section = Section::find($this->section->id);

                        $this->render_alerta('success', 'Registro añadido exitosamente');
                    } else {
                        $this->render_alerta('error', 'Completa los campos obligatorios');
                    }
                } catch (\Throwable $th) {

                    $this->render_alerta('error', 'Completa los campos obligatorios');
                    //throw $th;
                }
                break;

            default:
                # code...
                break;
        }
    }

    public function edit(Lesson $lesson)
    {

        $this->resetValidation();
        $this->lesson = $lesson;
        // dd($lesson->name);
        $this->formName = $lesson->name;
        $this->formPlatformId = $lesson->platform_id;
        $this->formUrl = $lesson->url ?? null;
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
                    'url' => $urlresorce . '?rel=0',
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

        switch ($this->formatType) {
            case 'Youtube':
                # code...

                try {

                    $this->validateOnly('formName');
                    $this->validateOnly('formPlatformId');
                    $this->validateOnly('formUrl');

                    $this->lesson->name = $this->formName;
                    $this->lesson->platform_id = $this->formPlatformId;
                    $this->lesson->url = $this->formUrl;

                    $this->lesson->save();
                    if ($this->file) {
                        $urlresorce = $this->file->store('cursos');
                        $this->lesson->resource()->create([
                            'url' => $urlresorce . '?rel=0',
                        ]);
                    }
                    // $this->lesson = new Lesson();

                    $this->section = Section::find($this->section->id);
                    $this->render_alerta('success', 'Registro actualizado exitosamente');
                } catch (\Throwable $th) {
                    // dd('error');
                    $this->render_alerta('error', 'Completa los campos obligatorios');
                    //throw $th;
                }
                break;

            case 'Vimeo':
                # code...
                try {

                    $this->validateOnly('formName');
                    $this->validateOnly('formPlatformId');
                    $this->validateOnly('formUrl');

                    if ($this->formatType == 'Vimeo') {
                        $this->rules['lesson.url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
                    }

                    $this->lesson->name = $this->formName;
                    $this->lesson->platform_id = $this->formPlatformId;
                    $this->lesson->url = $this->formUrl;

                    $this->lesson->save();
                    if ($this->file) {
                        $urlresorce = $this->file->store('cursos');
                        $this->lesson->resource()->create([
                            'url' => $urlresorce . '?rel=0',
                        ]);
                    }
                    // $this->lesson = new Lesson();

                    $this->section = Section::find($this->section->id);
                    $this->render_alerta('success', 'Registro actualizado exitosamente');
                } catch (\Throwable $th) {
                    // dd('error');
                    $this->render_alerta('error', 'Completa los campos obligatorios');
                    //throw $th;
                }

                break;

            case 'Texto':
                # code...

                try {
                    $this->validateOnly('formName');
                    $this->validateOnly('formPlatformId');

                    $this->lesson->name = $this->formName;
                    $this->lesson->platform_id = $this->formPlatformId;

                    $this->lesson->save();

                    $this->section = Section::find($this->section->id);
                    $this->render_alerta('success', 'Registro actualizado exitosamente');
                } catch (\Throwable $th) {
                    // dd('error');
                    $this->render_alerta('error', 'Completa los campos obligatorios');
                    //throw $th;
                }
                break;

            case 'Documento':
                # code...

                try {
                    $this->validateOnly('formName');
                    $this->validateOnly('formPlatformId');
                    $this->validateOnly('formUrl');

                    $this->lesson->name = $this->formName;
                    $this->lesson->platform_id = $this->formPlatformId;
                    $this->lesson->url = $this->formUrl;

                    $this->lesson->save();
                    if ($this->file) {
                        $urlresorce = $this->file->store('cursos');
                        $this->lesson->resource()->create([
                            'url' => $urlresorce . '?rel=0',
                        ]);
                    }
                    // $this->lesson = new Lesson();

                    $this->section = Section::find($this->section->id);
                    $this->render_alerta('success', 'Registro actualizado exitosamente');
                } catch (\Throwable $th) {

                    $this->render_alerta('error', 'Completa los campos obligatorios');
                    //throw $th;
                }
                break;

            default:
                # code...
                break;
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
