<?php

namespace App\Livewire;

use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\EvaluacionDesempeno;
use App\Models\EvaluadoresEvaluacionCompetenciasDesempeno;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CuestionarioEvaluacionDesempenoCompetencias extends Component
{
    use LivewireAlert;

    // Basicos
    public $evaluador;

    public $id_evaluacion;

    public $id_evaluado;

    public $id_periodo;

    public $autoevaluacion = false;

    public $periodo_seleccionado = 0;

    public $array_periodos;

    // Traer datos de la evaluación
    public $evaluacion;

    public $evaluado;

    public $competencias_evaluado;

    public $competencias_autoevaluado;

    // Campos para validación dependiendo de lo que el evaluador vaya a evaluar
    public $validacion_competencias_evaluador;

    public $escalas;

    public $conducta;

    public $porcentajeCalificado = 0;

    public $colaboradores_evaluar = [];

    // Se emite un evento que el livewire principal va a escuchar gracias a listeners
    public function sendDataToParent()
    {
        // Enviamos el progreso para que el livewire principal haga la validación para terminar la evaluación
        $this->dispatch('dataFromChild2', dataFromChild2: $this->porcentajeCalificado);
    }

    public function mount($id_evaluacion, $id_evaluado, $id_periodo)
    {
        $this->evaluador = User::getCurrentUser()->empleado;

        $this->id_evaluacion = $id_evaluacion;
        $this->id_evaluado = $id_evaluado;
        $this->id_periodo = $id_periodo;

        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        $this->evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);

        if ($this->evaluacion->activar_competencias == true) {
            $this->buscarCompetencias();
        }

        if ($this->evaluado->empleado->id == $this->evaluador->id) {
            $this->autoevaluacion = true;
        }

        $this->colaboradores_evaluar = EvaluadoresEvaluacionCompetenciasDesempeno::with('empleado')->where('periodo_id', $id_periodo)
        ->where('evaluador_desempeno_id', $this->evaluador->id)
        ->where('evaluado_desempeno_id', '!=', $this->evaluado->id)
        ->get();

        $this->progresoEvaluacion();
    }

    public function render()
    {
        return view('livewire.cuestionario-evaluacion-desempeno-competencias');
    }

    public function buscarCompetencias()
    {
        $this->validacion_competencias_evaluador = false;

        $busqueda_evaluador = $this->evaluado->evaluadoresCompetencias($this->id_periodo)->where('evaluador_desempeno_id', $this->evaluador->id)->first();
        $busqueda_autoevaluador = $this->evaluado->evaluadoresCompetencias($this->id_periodo)->where('evaluador_desempeno_id', $this->id_evaluado->evaluado_desempeno_id)->first();

        if ($busqueda_evaluador || $busqueda_autoevaluador) {
            $this->validacion_competencias_evaluador = true;

            if ($busqueda_evaluador) {
                $this->competencias_evaluado = $busqueda_evaluador->preguntasCuestionario->where('periodo_id', $this->id_periodo)->sortBy('id');
            }

            if ($busqueda_autoevaluador) {
                $this->competencias_autoevaluado = $busqueda_autoevaluador->preguntasCuestionario->where('periodo_id', $this->id_periodo)->sortBy('id');
            }
        }
    }

    public function evaluarCompetencia($id_competencia, $valor)
    {
        try {
            $competencia = CuestionarioCompetenciaEvDesempeno::find($id_competencia);
            $competencia->update([
                'calificacion_competencia' => intval($valor),
                'estatus_calificado' => true,
            ]);

            $this->buscarCompetencias();
            $this->progresoEvaluacion();
            $this->alertaGuardadoCorrecto();
        } catch (\Throwable $th) {
            $this->buscarCompetencias();
            $this->alertaGuardadoIncorrecto();
        }
    }

    public function progresoEvaluacion()
    {
        $nPreguntas = $this->competencias_evaluado->count();
        $contestadas = $this->competencias_evaluado->where('estatus_calificado', true)->count();
        $this->porcentajeCalificado = round((($contestadas / $nPreguntas) * 100), 2);

        $this->sendDataToParent();
    }

    public function alertaGuardadoCorrecto()
    {
        $this->alert('success', 'Respuesta Guardada', [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'text' => 'La respuesta se ha guardado correctamente.',
        ]);
    }

    public function alertaGuardadoIncorrecto()
    {
        $this->alert('error', 'Error', [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'text' => 'Ha ocurrido un error al guardar la respuesta.',
        ]);
    }
}
