<?php

namespace App\Livewire;

use Livewire\Component;

class VisualizarDocumentosGeneradosComponent extends Component
{
    public $nombre_documento;

    public function mount($nombre_control_documento)
    {
        $this->nombre_documento = $nombre_control_documento;
    }

    public function render()
    {
        $ISO27001_SoA_PATH = 'storage/Normas/ISO27001/';
        $path = public_path($ISO27001_SoA_PATH);
        $lista_archivos_declaracion_pdf = glob($path.$this->nombre_documento.'*.pdf');
        $lista_archivos_declaracion_docx = glob($path.$this->nombre_documento.'*.docx');

        return view('livewire.visualizar-documentos-generados-component', compact('lista_archivos_declaracion_pdf', 'lista_archivos_declaracion_docx', 'ISO27001_SoA_PATH'));
    }

    public function obtenerDocumentosGenerados($nombre)
    {
        $this->nombre_documento = $nombre;
    }
}
