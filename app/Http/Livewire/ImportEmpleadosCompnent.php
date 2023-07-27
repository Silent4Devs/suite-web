<?php

namespace App\Http\Livewire;

use App\Imports\EmpleadoImport;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportEmpleadosCompnent extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $file;

    public function updatedFile()
    {
        $this->validateFile();
    }

    public function import()
    {
        // try {
        $this->validateFile();
        Excel::import(new EmpleadoImport, $this->file);
        $this->alert('success', 'Bien Hecho!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Se han importado los datos correctamente',
        ]);
        // } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //     $failures = $e->failures();
        //     foreach ($failures as $failure) {
        //         $failure->row(); // row that went wrong
        //         $failure->attribute(); // either heading key (if using heading row concern) or column index
        //         $failure->errors(); // Actual error messages from Laravel validator
        //         $failure->values(); // The values of the row that has failed.
        //     }
        // }
    }

    public function validateFile()
    {
        $mb = 10;
        $kb = $mb * 1024;
        $this->validate([
            'file' => 'required|mimes:xlsx,csv|max:'.$kb, // 1MB Max
        ], [
            'file.required' => 'El archivo de importación es requerido',
            'file.mimes' => 'Solo se permiten archivos tipo Excel y CSV',
            'file.max' => 'El peso máximo del archivo es de '.$mb.' MB',
        ]);
    }

    public function render()
    {
        return view('livewire.import-empleados-compnent');
    }
}
