<?php

namespace App\Http\Livewire;

use App\Models\RespuestasEvaluacionAnalisisBrechas;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Iso27\AnalisisBrechasIso;
use App\Models\EvaluacionAnalisisBrechas;

class EvaluacionAnalisisBrechasLivewire extends Component
{
    use ObtenerOrganizacion;

    public $itemId;
    public $analisisId; // Renamed from $id
    public $seccion_vista = 0;

    public $selectedValues;

    public $oldSelectedValues;

    public $evidenciaValues;

    public $oldEvidenciaValues;

    public $recomendacionValues;

    public $oldRecomendacionValues = []; // Store old values

    public $cuentas;

    public $totalAnalisis;

    public $results;

    public $grafica_cuentas2 = [];
    public $grafica_colores2= [];
    public $resultskeys = [];

    // public $imageImprimir ;
    public $logo_actual;


    public function mount($id)
    {

        $this->analisisId = $id;
        $this->imageImprimir = file_get_contents(public_path('imprimir.svg'));
    }

    public function render()
    {
        // $analisisBrecha = AnalisisBrechasIso::with('evaluacionTemplateAnalisisBrechas')->find($this->analisisId);

        $analisisBrecha = AnalisisBrechasIso::with('evaluacionAnalisisBrechas')->find($this->analisisId);
        // dd($analisisBrecha->evaluacionAnalisisBrechas);


        $this->itemId = $analisisBrecha->evaluacionAnalisisBrechas->id;

        $template_general = EvaluacionAnalisisBrechas::with('parametros')
            ->with('secciones')
            ->find($this->itemId);

        if ($this->seccion_vista != 0) {

            $template = EvaluacionAnalisisBrechas::with('parametros')
                ->withwhereHas('secciones', function ($query) {
                    return $query->with('preguntas.respuesta')->where('numero_seccion', '=', $this->seccion_vista);
                })
                ->find($this->itemId);


            foreach ($template->secciones as $key => $seccion) {
                foreach ($seccion->preguntas as $key => $pregunta) {
                    $this->selectedValues[$pregunta->id]['option1'] = old("selectedValues.{$pregunta->id}.option1", $pregunta->respuesta->parametro->id ?? null);
                    $this->oldSelectedValues[$pregunta->id]['option1'] = $this->selectedValues[$pregunta->id]['option1'];

                    $this->evidenciaValues[$pregunta->id] = old('recomendacionValues.'.$pregunta->id, $pregunta->respuesta->evidencia ?? '');
                    $this->oldEvidenciaValues[$pregunta->id] = $this->evidenciaValues[$pregunta->id];

                    $this->recomendacionValues[$pregunta->id] = old('recomendacionValues.'.$pregunta->id, $pregunta->respuesta->recomendacion ?? '');
                    $this->oldRecomendacionValues[$pregunta->id] = $this->recomendacionValues[$pregunta->id];
                }
            }

            $result = $this->sumaParametrosSeccion($this->seccion_vista);
            // dd($result);
            $this->cuentas = $result['counts'];
            $peso_parametros = $result['porcentaje_parametros'];
            // dd($peso_parametros);
            $totalCount = $result['totalCount'];
            $totalPorcentaje = $result['total_porcentaje'];
            $sectionPercentages = $this->porcentajeSeccion($this->seccion_vista);

            $grafica_cuentas = [];
            $grafica_colores = [];
            foreach ($template->parametros as $parametro) {
                if (array_key_exists($parametro->id, $this->cuentas)) {
                    $grafica_cuentas[$parametro->estatus] = $this->cuentas[$parametro->id];
                    $grafica_colores[] = $parametro->color;
                }
            }
            $this->emit('renderAreas', $grafica_cuentas, $grafica_colores);
        } else {
            $template = $template_general;
            $result = $this->sumaParametrosTotal();
            $result2 = [];
            $limit = $template->no_secciones;
            for ($i = 1; $i <= $limit; $i++) {
                $result3 = $this->sumaParametrosSeccion($i);
                array_push($result2, $result3);
            }
            $this->results = $result2;
            

            $this->cuentas = $result['counts'];
            
            $peso_parametros = $result['porcentaje_parametros'];
            
            $totalCount = $result['totalCount'];
            $totalPorcentaje = $result['total_porcentaje'];

            $sectionPercentages = $this->porcentajeTotal();

            

            $grafica_cuentas = [];
            $grafica_colores = [];
            foreach ($template->parametros as $parametro) {
                if (array_key_exists($parametro->id, $this->cuentas)) {
                    $grafica_cuentas[$parametro->estatus] = $this->cuentas[$parametro->id];

                    $grafica_colores[] = $parametro->color;
                }
            }
            $this->grafica_cuentas2 = $grafica_cuentas;
            
            $resultskeys = [];
            $keys = $template->secciones->keys();
        foreach($keys as $key){
            $key=$key+1;
            $resultkey = $this->sumaParametrosSeccion($key);
            
            array_push($resultskeys,$resultkey['counts']);
        }
        $this->grafica_colores2 = $grafica_colores;
        $this->resultskeys = $resultskeys;

        $this->emit('renderAreas', $grafica_cuentas, $grafica_colores);
        $this->emit('renderGraficsModal', $this->grafica_cuentas2,$resultskeys);


        }

        $this->totalAnalisis = $this->porcentajeTotal()[0]['percentage'];
        //sirve para mostrar las respuesta ya existentes, no se pudo poner en hydrate()

        // $this->emit('renderAreas', $grafica_cuentas, $grafica_colores);
        // $this->emit('mounted');
        // dd($cuentas);
        // dd($sectionPercentages);
        $organizacion_actual = $this->obtenerOrganizacion();
        $this->logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $direccion = $organizacion_actual->direccion;
        $rfc = $organizacion_actual->rfc;

        // dd($this->logo_actual);

        // $this->imageImprimir = public_path('imprimir.svg');
        

        $this->emit('renderAreas1');

        return view('livewire.evaluacion-analisis-brechas-livewire', compact(
            'template',
            'template_general',
            // 'cuentas',
            'totalCount',
            'sectionPercentages',
            'peso_parametros',
            'totalPorcentaje',
            'organizacion_actual', 'empresa_actual', 'direccion', 'rfc'
        ));
    }

    public function sumaParametrosSeccion($sec_param)
    {
        $template = EvaluacionAnalisisBrechas::with('parametros')
            ->withwhereHas('secciones', function ($query) use ($sec_param) {
                return $query->with('preguntas.respuesta')->where('numero_seccion', '=', $sec_param);
            })
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
            $valor_seccion = $seccion->porcentaje_seccion;
        }

        foreach ($template->parametros as $parametro) {
            $porcentaje_parametros[$parametro->id] = (($counts[$parametro->id] * $parametro->valor) / $maxPossibleValue) * $valor_seccion;
            $total_porcentaje += $porcentaje_parametros[$parametro->id];
        }

        return ['counts' => $counts, 'totalCount' => $totalCount, 'porcentaje_parametros' => $porcentaje_parametros, 'total_porcentaje' => $total_porcentaje];
    }

    public function porcentajeSeccion($sec_porc)
    {
        $template = EvaluacionAnalisisBrechas::with('parametros')
            ->withwhereHas('secciones', function ($query) use ($sec_porc) {
                return $query->with('preguntas.respuesta')->where('numero_seccion', '=', $sec_porc);
            })
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

            $percentage = $totalQuestionsInSection > 0 ? ($answeredQuestions / $totalQuestionsInSection) * $seccion->porcentaje_seccion : 0;

            $sectionPercentages[$seccion->numero_seccion] = [
                'answeredQuestions' => $answeredQuestions,
                'totalQuestionsInSection' => $totalQuestionsInSection,
                'percentage' => $percentage,
            ];
        }

        return $sectionPercentages;
    }

    //Se comento porque sale el total de todas las preguntas de todas las secciones,
    // y debe ser por seccion, podria ser util
    public function sumaParametrosTotal()
    {
        $template = EvaluacionAnalisisBrechas::with('parametros')
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

    public function porcentajeTotal()
    {
        $percentage = 0;
        $template = EvaluacionAnalisisBrechas::with('parametros')
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

            // $percentage = $totalQuestionsInSection > 0 ? ($answeredQuestions / $totalQuestionsInSection) * 100 : 0;

            $sectionPercentages[$seccion->numero_seccion] = $this->sumaParametrosSeccion($seccion->numero_seccion);
            // dd($sectionPercentages);
            $percentage += $sectionPercentages[$seccion->numero_seccion]['total_porcentaje'];
        }

        // dd($sectionPercentages, $percentage);
        $sectionPercentages[0] = [
            'answeredQuestions' => $answeredQuestions,
            'totalQuestionsInSection' => $totalQuestionsInSection,
            'percentage' => $percentage,
        ];

        // dd($sectionPercentages);
        return $sectionPercentages;
    }

    public function changeSeccion($newSeccion)
    {
        $this->seccion_vista = $newSeccion;
        
        
    }

    public function saveDataParametros($preguntaID, $parametroID)
    {
        //Se recolectan los valores, el id de la pregunta, y el id del parametro,
        //asi se obtendran los valores de esa relacion
        // $this->selectedValues["parametro_id"] = $parametroID;
        // $this->selectedValues["pregunta_id"] = $preguntaID;

        // dd($this->selectedValues);

        RespuestasEvaluacionAnalisisBrechas::updateOrCreate(
            ['pregunta_id' => $preguntaID, 'ev_analisis_template_id' => $this->itemId ], // Search criteria
            ['parametro_id' => $parametroID], // Values to update or create
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

    public function eventoRefrescar()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
    }

    
}
