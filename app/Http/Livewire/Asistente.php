<?php

namespace App\Http\Livewire;

use App\Services\AsistentService;
use Livewire\Component;

class Asistente extends Component
{

    public $search = '';

    protected $asistenService; // Declarar como protegida

    public $respuesta;
    public $filename;
    public $filePath;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->asistenService = app(AsistentService::class);
    }

    public function postDataText()
    {
        $result = $this->asistenService->postDataTextPythonAPI($this->filePath, $this->filename);

        return $result;
    }

    public function postData()
    {
        $result = $this->asistenService->postDataToPythonAPI($this->filename);

        return $result;
    }

    public function askAsistenText()
    {

        $this->filename = 'guia.pdf';

        $this->postData();

        // Asignar la ruta completa del archivo a $this->filePath
        $this->filePath = storage_path('Guia.pdf');

        $this->postDataText();
    }

    public function askAsisten()
    {
        $response = $this->asistenService->postQuestionToPythonAPI($this->search);
        $this->respuesta = response()->json($response);
        $this->respuesta = $response;
    }
    public function render()
    {
        return view('livewire.asistente');
    }
}