<?php

namespace App\Http\Livewire;

use App\Models\TemplateAnalisisdeBrechas;
use Livewire\Component;

class EvaluacionAnalisisBrechas extends Component
{
    public $itemId; // Renamed from $id
    public $seccion = 1;

    public function mount($id)
    {
        $this->itemId = $id;
    }
    public function render()
    {
        $template_general = TemplateAnalisisdeBrechas::with('parametros')
            ->with('secciones')
            ->find($this->itemId);
        $template = TemplateAnalisisdeBrechas::with('parametros')
            ->withwhereHas('secciones', function ($query) {
                return $query->with('preguntas')->where('numero_seccion', '=', $this->seccion);
            })
            ->find($this->itemId);
        // dd($template);
        return view('livewire.evaluacion-analisis-brechas', compact('template', 'template_general'));
    }
}
