<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\EvaluacionDesempeno;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CuestionarioEvaluacionDesempenoCompetencias extends Component
{
    use LivewireAlert;

    //Basicos
    public $evaluador;
    public $id_evaluacion;
    public $id_evaluado;

    public $autoevaluacion = false;

    public $periodo_seleccionado = 0;
    public $array_periodos;

    //Traer datos de la evaluación
    public $evaluacion;
    public $evaluado;
    public $competencias_evaluado;
    public $competencias_autoevaluado;

    //Campos para validación dependiendo de lo que el evaluador vaya a evaluar
    public $validacion_competencias_evaluador;

    public $escalas;
    public $conducta;

    public $porcentajeCalificado = 0;

    public function mount($id_evaluacion, $id_evaluado)
    {
        $this->evaluador = User::getCurrentUser()->empleado;

        $this->id_evaluacion = $id_evaluacion;
        $this->id_evaluado = $id_evaluado;

        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        $this->evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);

        $this->cuestionarioSecciones();
        if ($this->evaluacion->activar_competencias == true) {
            $this->buscarCompetencias();
        }

        if ($this->evaluado->empleado->id == $this->evaluador->id) {
            $this->autoevaluacion = true;
        }

        $this->progresoEvaluacion();
    }

    public function render()
    {
        return view('livewire.cuestionario-evaluacion-desempeno-competencias');
    }

    public function cuestionarioSecciones()
    {
        foreach ($this->evaluacion->periodos as $key => $periodo) {
            $this->array_periodos[$key] = [
                "id_periodo" => $periodo->id,
                "nombre_evaluacion" => $periodo->nombre_evaluacion,
                "fecha_inicio" => $periodo->fecha_inicio,
                "fecha_fin" => $periodo->fecha_fin,
                "habilitado" => $periodo->habilitado,
                "finalizado" => $periodo->finalizado,
            ];
        }
    }

    public function buscarCompetencias()
    {
        $this->validacion_competencias_evaluador = false;
        foreach ($this->evaluado->evaluadoresCompetencias as $key => $evlr) {
            if ($evlr->evaluador_desempeno_id == $this->evaluador->id) {
                $this->validacion_competencias_evaluador = true;

                $this->competencias_evaluado = $evlr->preguntasCuestionario->where('periodo_id', $this->array_periodos[$this->periodo_seleccionado]["id_periodo"])->sortBy('id');
            }

            if ($evlr->evaluador_desempeno_id == $this->evaluado->evaluado_desempeno_id) {
                $this->validacion_competencias_evaluador = true;
                $this->competencias_autoevaluado = $evlr->preguntasCuestionario->where('periodo_id', $this->array_periodos[$this->periodo_seleccionado]["id_periodo"])->sortBy('id');
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
