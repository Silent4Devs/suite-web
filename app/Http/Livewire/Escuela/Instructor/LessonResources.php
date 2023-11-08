<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Lesson;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LessonResources extends Component
{
    use WithFileUploads;

    public $lesson;
    public $file;

    protected $messages = [
        'file.required' => 'El archivo es obligatorio',
    ];

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.lesson-resources');
    }

    public function save()
    {
        $this->validate([
            'file' => 'required',
        ]);

        $url = $this->file->store('cursos');

        $this->lesson->resource()->create([
            'url' => $url,
        ]);

        $this->lesson = Lesson::find($this->lesson->id);
    }

    public function destroy()
    {
        Storage::delete($this->lesson->resource->url);
        $this->lesson->resource->delete();
        $this->lesson = Lesson::find($this->lesson->id);
    }

    public function download()
    {
        // dd($this->lesson->resource);
        return response()->download(storage_path('app/' . $this->lesson->resource->url));
    }
}
