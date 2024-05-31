<?php

namespace App\Livewire;

use App\Models\FilesRevisonDireccion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileRevisionDireecionComponent extends Component
{
    use WithFileUploads;

    public $minutas;

    public $files = [];

    protected $listeners = ['render'];

    public function render()
    {
        $path = asset('storage/FilesRevisionDireccion');

        return view('livewire.file-revision-direecion-component', compact('path'));
    }

    public function destroy($id)
    {
        $model = FilesRevisonDireccion::find($id);
        $model->delete();
        $this->dispatch('render');
    }

    public function save()
    {
        foreach ($this->files as $file) {
            if (Storage::putFileAs('public/FilesRevisionDireccion', $file, $file->getClientOriginalName())) {
                FilesRevisonDireccion::create([
                    'name' => $file->getClientOriginalName(),
                    'revision_id' => $this->minutas->id,
                ]);
            }
        }
        $this->dispatch('render');
        $this->files = [];
        $this->dispatch('archivosGuardados');
    }
}
