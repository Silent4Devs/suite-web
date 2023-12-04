<?php

namespace App\Http\Livewire;

use App\Models\RespuestasEvaluacionAnalisisBrechas;
use App\Models\TemplateAnalisisdeBrechas;
use Livewire\Component;

class EvaluacionAnalisisBrechas extends Component
{
    public $itemId; // Renamed from $id
    public $seccion = 1;

    public $selectedValues;
    public $oldSelectedValues;
    public $evidenciaValues;
    public $oldEvidenciaValues;
    public $recomendacionValues;
    public $oldRecomendacionValues = []; // Store old values

    public $cuentas;
    // public $preguntasCount;

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
                $this->selectedValues[$pregunta->id]['option1'] = old("selectedValues.{$pregunta->id}.option1", $pregunta->respuesta->parametro->id ?? null);
                $this->oldSelectedValues[$pregunta->id]['option1'] = $this->selectedValues[$pregunta->id]['option1'];

                $this->evidenciaValues[$pregunta->id] = old('recomendacionValues.' . $pregunta->id, $pregunta->respuesta->evidencia ?? '');
                $this->oldEvidenciaValues[$pregunta->id] = $this->evidenciaValues[$pregunta->id];

                $this->recomendacionValues[$pregunta->id] = old('recomendacionValues.' . $pregunta->id, $pregunta->respuesta->recomendacion ?? '');
                $this->oldRecomendacionValues[$pregunta->id] = $this->recomendacionValues[$pregunta->id];
            }
        }

        $parametrosEstatus = ['Status A', 'Status B', 'Status C']; // Sample array
        $preguntasCount = [10, 20, 15]; // Sample array or collection

        $result = $this->sumaParametros();
        // dd($result);
        $cuentas = $result['counts'];
        $peso_parametros = $result['porcentaje_parametros'];
        $totalCount = $result['totalCount'];
        $totalPorcentaje = $result['total_porcentaje'];

        $sectionPercentages = $this->porcentajeSeccion();

        $this->cuentas = $cuentas;
        $this->emit('renderAreas', $this->cuentas);

        return view('livewire.evaluacion-analisis-brechas', compact(
            'template',
            'template_general',
            'cuentas',
            'totalCount',
            'sectionPercentages',
            'peso_parametros',
            'totalPorcentaje'
        ));
    }

    public function sumaParametros()
    {
        $template = TemplateAnalisisdeBrechas::with('parametros')
            ->with(['secciones.preguntas.respuesta']) // Eager load necessary relationships
            ->find($this->itemId);

        $maxParametroValue = $template->parametros->max('valor'); // Find the highest value among parametros

        $totalPreguntas = 0;
        foreach ($template->secciones as $seccion) {
            $totalPreguntas += $seccion->preguntas->count(); // Count total number of preguntas across all secciones
        }

        // Calculate the maximum possible value based on highest parametro value multiplied by total preguntas
        $maxPossibleValue = $maxParametroValue * $totalPreguntas;

        $counts = []; // Array to store counts for each parameter
        $porcentaje_parametros = [];
        $totalCount = 0; // Total count for all parameters
        $total_porcentaje = 0;

        foreach ($template->parametros as $parametro) {
            $counts[$parametro->id] = 0; // Initialize count for each parameter
            $porcentaje_parametros[$parametro->id] = 0;
        }

        foreach ($template->secciones as $seccion) {
            foreach ($seccion->preguntas as $pregunta) {
                $respuestaParametroId = $pregunta->respuesta ? $pregunta->respuesta->parametro_id : null;

                // Increment the count for the corresponding parameter ID if it matches the respuesta's parametro_id
                if (array_key_exists($respuestaParametroId, $counts)) {
                    $counts[$respuestaParametroId]++;
                    $totalCount++; // Increment total count
                }
            }
        }

        foreach ($template->parametros as $parametro) {
            $porcentaje_parametros[$parametro->id] = (($counts[$parametro->id] * $parametro->valor) / $maxPossibleValue) * 100;
            $total_porcentaje += $porcentaje_parametros[$parametro->id];
        }

        return ['counts' => $counts, 'totalCount' => $totalCount, 'porcentaje_parametros' => $porcentaje_parametros, 'total_porcentaje' => $total_porcentaje];
    }

    public function porcentajeSeccion()
    {
        $template = TemplateAnalisisdeBrechas::with('parametros')
            ->with(['secciones' => function ($query) {
                $query->with(['preguntas' => function ($query) {
                    $query->with('respuesta');
                }]);
            }])
            ->find($this->itemId);

        $sectionPercentages = [];

        foreach ($template->secciones as $seccion) {
            $answeredQuestions = 0;
            $totalQuestionsInSection = $seccion->preguntas->count();

            foreach ($seccion->preguntas as $pregunta) {
                if ($pregunta->respuesta) {
                    $answeredQuestions++;
                }
            }

            $percentage = $totalQuestionsInSection > 0 ? ($answeredQuestions / $totalQuestionsInSection) * 100 : 0;

            $sectionPercentages[$seccion->id] = [
                'answeredQuestions' => $answeredQuestions,
                'totalQuestionsInSection' => $totalQuestionsInSection,
                'percentage' => $percentage,
            ];
        }

        return $sectionPercentages;
    }

    public function changeSeccion($newSeccion)
    {
        $this->seccion = $newSeccion;
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
