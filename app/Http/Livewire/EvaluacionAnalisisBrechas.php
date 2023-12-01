<?php

namespace App\Http\Livewire;

use App\Models\RespuestasEvaluacionAnalisisBrechas;
use App\Models\TemplateAnalisisdeBrechas;
use Livewire\Component;

class EvaluacionAnalisisBrechas extends Component
{
    public $itemId; // Renamed from $id
    public $seccion = 1;

    public $selectedValues = [];
    public $evidenciaValues;
    public $recomendacionValues;
    public $oldRecomendacionValues = []; // Store old values

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
                return $query->with('preguntas.respuesta')->where('numero_seccion', '=', $this->seccion);
            })
            ->find($this->itemId);

        //sirve para mostrar las respuesta ya existentes, no se pudo poner en hydrate()
        foreach ($template->secciones as $key => $seccion) {
            foreach ($seccion->preguntas as $key => $pregunta) {
                $this->recomendacionValues[$pregunta->id] = old('recomendacionValues.' . $pregunta->id, $pregunta->respuesta->recomendacion ?? '');
                $this->oldRecomendacionValues[$pregunta->id] = $this->recomendacionValues[$pregunta->id];
            }
        }
        return view('livewire.evaluacion-analisis-brechas', compact('template', 'template_general'));
    }

    public function saveDataParametros($preguntaID, $parametroID)
    {
        //Se recolectan los valores, el id de la pregunta, y el id del parametro,
        //asi se obtendran los valores de esa relacion
        // $this->selectedValues["parametro_id"] = $parametroID;
        // $this->selectedValues["pregunta_id"] = $preguntaID;

        // dd($this->selectedValues);

        RespuestasEvaluacionAnalisisBrechas::updateOrCreate(
            ['pregunta_id' => $preguntaID], // Search criteria
            ['parametro_id' => $parametroID, 'some_field' => $parametroID] // Values to update or create
        );
    }

    public function saveEvidencia($preguntaID)
    {
        $evidenciaValue = $this->evidenciaValues[$preguntaID] ?? null;


        if ($evidenciaValue !== null) {
            // Update or create based on pregunta_id
            RespuestasEvaluacionAnalisisBrechas::updateOrCreate(
                ['pregunta_id' => $preguntaID], // Search criteria
                ['evidencia' => $evidenciaValue] // Value to update or create
            );
        }
    }

    public function saveRecomendacion($preguntaID)
    {
        $recomendacionValue = $this->recomendacionValues[$preguntaID] ?? null;


        if ($recomendacionValue !== null) {
            // Update or create based on pregunta_id
            RespuestasEvaluacionAnalisisBrechas::updateOrCreate(
                ['pregunta_id' => $preguntaID], // Search criteria
                ['recomendacion' => $recomendacionValue] // Value to update or create
            );
        }
    }
}
