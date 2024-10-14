<?php

namespace App\Livewire;

use App\Services\AsistentService;
use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Asistente extends Component
{
    public $search = '';
    public $respuesta;
    public $lineas;
    public $filename;
    public $filePath;
    public $chatboxOpen = false;
    
    public $preguntas = [];
    public $respuestas = [];
    public $firstMessageVisible = true;

    public function mount()
    {
        $this->loadChatData();
    }

    public function loadChatData()
    {
        $storedQuestions = json_decode(session('stored_questions', '[]'), true);
        $storedAnswers = json_decode(session('stored_answers', '[]'), true);

        $this->preguntas = $storedQuestions;
        $this->respuestas = $storedAnswers;

        if (count($this->preguntas) > 0) {
            $this->firstMessageVisible = false;
        }
    }

    public function toggleChatbox()
    {
        $this->chatboxOpen = !$this->chatboxOpen;
        $this->search = '';
        $this->respuesta = '';
        $this->firstMessageVisible = true;
    }

    public function askAsisten()
    {
        $asistenService = app(AsistentService::class);
        
        $this->preguntas[] = $this->search;

        $response = $asistenService->postQuestionToPythonAPI($this->search);
        
        if (is_array($response) && isset($response['response'])) {
            $tr = new GoogleTranslate('es');
            $respuestaEnEspanol = $tr->translate($response['response']);
            $this->respuestas[] = $respuestaEnEspanol;
        } else {
            $this->respuestas[] = 'Error: respuesta no válida';
        }

        $this->firstMessageVisible = false;
        $this->updatedPreguntas();
        $this->search = '';
    }

    public function updatedPreguntas()
    {
        session(['stored_questions' => json_encode($this->preguntas)]);
        session(['stored_answers' => json_encode($this->respuestas)]);
    }

    public function render()
    {
        return view('livewire.asistente');
    }
}
