<?php

namespace App\Livewire;

use App\Services\AsistentService;
use Livewire\Component;

class Asistente extends Component
{
    public $search = '';
    public $respuesta;
    public $lineas;
    public $filename;
    public $filePath;
    public $chatboxOpen = false;

    public function toggleChatbox()
    {
        $this->chatboxOpen = ! $this->chatboxOpen;
        $this->search = '';
        $this->respuesta = '';
    }

    public function postDataText()
    {
        $asistenService = app(AsistentService::class);
        $result = $asistenService->postDataTextPythonAPI($this->filePath, $this->filename);
        return $result;
    }

    public function postData()
    {
        $asistenService = app(AsistentService::class);
        $result = $asistenService->postDataToPythonAPI($this->filename);
        return $result;
    }

    public function askAsistenText()
    {
        $this->filename = 'requisicion.pdf';
        $this->postData();
        $this->filePath = storage_path('requisicion.pdf');
        $this->postDataText();
    }

    public function askAsisten()
    {
        $asistenService = app(AsistentService::class);
        $response = $asistenService->postQuestionToPythonAPI($this->search);
        $this->respuesta = response()->json($response);
        $this->respuesta = $response;
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.asistente');
    }
}
