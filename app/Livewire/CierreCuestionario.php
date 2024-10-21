<?php

namespace App\Livewire;

use App\Models\User;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CierreCuestionario extends Component
{
    public $evaluador;

    public $id_evaluacion;

    public $id_evaluado;

    public $signatureData;

    public function mount($id_evaluacion, $id_evaluado)
    {
        $this->evaluador = User::getCurrentUser()->empleado;

        $this->id_evaluacion = $id_evaluacion;
        $this->id_evaluado = $id_evaluado;
    }

    public function render()
    {
        return view('livewire.cierre-cuestionario');
    }

    public function saveSignature(TemporaryUploadedFile $image)
    {
        $image = Image::make($image->getRealPath());
        // Save the image to the storage or public directory
        $image->save(public_path('signatures/'.uniqid().'.png'));

        // Optionally, you can save the image path to a database
        // $signature = Signature::create(['path' => $imagePath]);

        // Clear the signature data after saving
        $this->signatureData = null;

        session()->flash('message', 'Signature saved successfully.');
    }
}
