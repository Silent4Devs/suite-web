<?php

namespace App\Http\Livewire;

use App\Models\EscalasMedicionObjetivos;
use App\Models\EvaluacionDesempeno;
use App\Models\User;
use Livewire\Component;

class CuestionarioEvaluacionDesempeno extends Component
{
    public $evaluacion;
    public $evaluado;
    public $objetivos_evaluado;
    public $competencias_evaluado;

    public $escalas;

    public function mount($id_evaluacion, $id_evaluado)
    {
        $evaluador = User::getCurrentUser()->empleado;
        // dd($id_evaluacion, $id_evaluado);
        $this->evaluacion = EvaluacionDesempeno::find($id_evaluacion);
        $this->evaluado = $this->evaluacion->evaluados->find($id_evaluado);
        if ($this->evaluacion->activar_competencias == true && $this->evaluacion->activar_objetivos == true) {
            //Comprobacion de que el evaluador si sea uno de los seleccionados
            $validacion_objetivos_evaluador = $this->evaluado->evaluadoresObjetivos->where('evaluador_desempeno_id', $evaluador->id);

            $validacion_competencias_evaluador = $this->evaluado->evaluadoresCompetencias->where('evaluador_desempeno_id', $evaluador->id);

            dd($validacion_objetivos_evaluador, $validacion_competencias_evaluador);
        } elseif ($this->evaluacion->activar_competencias == true && $this->evaluacion->activar_objetivos == false) {
            $validacion_competencias_evaluador = $this->evaluado->evaluadoresCompetencias->where('evaluador_desempeno_id', $evaluador->id);

            dd($validacion_competencias_evaluador);
        } elseif ($this->evaluacion->activar_competencias == false && $this->evaluacion->activar_objetivos == true) {

            $this->escalas = EscalasMedicionObjetivos::get();

            $validacion_objetivos_evaluador = false;
            foreach ($this->evaluado->evaluadoresObjetivos as $key => $evlr) {
                if ($evlr->evaluador_desempeno_id == $evaluador->id) {
                    $validacion_objetivos_evaluador = true;

                    $this->objetivos_evaluado = $evlr->preguntasCuestionario;

                    break;
                }
            }

            // dd($validacion_objetivos_evaluador);
        } else {
            return redirect()->route('admin.inicio-Usuario.index');
        }
        // dd($this->evaluacion, $this->evaluado);
    }

    public function render()
    {
        return view('livewire.cuestionario-evaluacion-desempeno');
    }
}
