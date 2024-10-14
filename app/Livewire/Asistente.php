<?php

namespace App\Livewire;

use App\Services\AsistentService;
use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate; // Agregar la clase para traducción

class Asistente extends Component
{
    public $search = '';

    public $respuesta;

    public $lineas;

    public $filename;

    public $filePath;

    public $chatboxOpen = false;

    // Nuevo array para almacenar las preguntas
    public $preguntas = [];

    public $respuestas = []; // Asegúrate de tener esta propiedad para las respuestas

    // Nueva propiedad para controlar la visibilidad del mensaje de bienvenida
    public $firstMessageVisible = true;

    public function toggleChatbox()
    {
        $this->chatboxOpen = ! $this->chatboxOpen;
        $this->search = '';
        $this->respuesta = '';
        $this->firstMessageVisible = true; // Reiniciar la visibilidad al abrir el chat
    }

    public function askAsisten()
    {
        $asistenService = app(AsistentService::class);

        // Guardar la pregunta en el array
        $this->preguntas[] = $this->search;

        $response = $asistenService->postQuestionToPythonAPI($this->search);

        // Verificar si la respuesta es un array y acceder a la cadena
        if (is_array($response) && isset($response['response'])) {
            // Traducir la respuesta al español antes de guardarla
            $tr = new GoogleTranslate('es'); // Establecer idioma a español
            $respuestaEnEspanol = $tr->translate($response['response']);
            
            // Añadir la respuesta traducida al array
            $this->respuestas[] = $respuestaEnEspanol;
        } else {
            $this->respuestas[] = 'Error: respuesta no válida';
        }

        // Cambiar la visibilidad del mensaje de bienvenida
        $this->firstMessageVisible = false;

        $this->search = ''; // Limpiar el input de búsqueda
    }

    public function render()
    {
        return view('livewire.asistente');
    }
}
