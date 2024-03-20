<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\EscalasMedicionObjetivos;
use App\Models\EvaluacionDesempeno;
use App\Models\RH\Conducta;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class CuestionarioEvaluacionDesempeno extends Component
{
    use LivewireAlert;

    //Basicos
    public $evaluador;
    public $id_evaluacion;
    public $id_evaluado;

    //Traer datos de la evaluación
    public $evaluacion;
    public $evaluado;
    public $objetivos_evaluado;
    public $competencias_evaluado;

    //Campos para validación dependiendo de lo que el evaluador vaya a evaluar
    public $validacion_objetivos_evaluador;
    public $validacion_competencias_evaluador;

    public $escalas;
    public $conducta;

    public function mount($id_evaluacion, $id_evaluado)
    {
        $this->evaluador = User::getCurrentUser()->empleado;
    }

    public function render()
    {
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        $this->evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);
        if ($this->evaluacion->activar_competencias == true && $this->evaluacion->activar_objetivos == true) {
            //Comprobacion de que el evaluador si sea uno de los seleccionados
            $this->buscarObjetivos();

            $this->buscarCompetencias();

            $this->comprobacion();
        } elseif ($this->evaluacion->activar_competencias == true && $this->evaluacion->activar_objetivos == false) {

            $this->buscarCompetencias();

            $this->comprobacion();
        } elseif ($this->evaluacion->activar_competencias == false && $this->evaluacion->activar_objetivos == true) {

            $this->buscarObjetivos();

            $this->comprobacion();
        } else {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return view('livewire.cuestionario-evaluacion-desempeno');
    }

    public function buscarObjetivos()
    {
        $this->escalas = EscalasMedicionObjetivos::get();

        $this->validacion_objetivos_evaluador = false;

        foreach ($this->evaluado->evaluadoresObjetivos as $key => $evlr) {
            if ($evlr->evaluador_desempeno_id == $this->evaluador->id) {
                $this->validacion_objetivos_evaluador = true;

                $this->objetivos_evaluado = $evlr->preguntasCuestionario->sortBy('id');

                break;
            }
        }
    }

    public function buscarCompetencias()
    {
        $this->validacion_competencias_evaluador = false;
        foreach ($this->evaluado->evaluadoresCompetencias as $key => $evlr) {
            if ($evlr->evaluador_desempeno_id == $this->evaluador->id) {
                $this->validacion_competencias_evaluador = true;

                $this->competencias_evaluado = $evlr->preguntasCuestionario->sortBy('id');
                break;
            }
        }
    }

    public function comprobacion()
    {
        if ($this->validacion_competencias_evaluador == false &&  $this->validacion_objetivos_evaluador == false) {
            return redirect()->route('admin.inicio-Usuario.index');
        }
    }

    public function evaluarObjetivo($id_objetivo, $valor)
    {
        try {
            $objetivo = CuestionarioObjetivoEvDesempeno::find($id_objetivo);
            $objetivo->update([
                'calificacion_objetivo' => $valor,
                'estatus_calificado' => true,
            ]);

            $this->alertaGuardadoCorrecto();
            $this->buscarObjetivos();
        } catch (\Throwable $th) {
            $this->alertaGuardadoIncorrecto();
            $this->buscarObjetivos();
        }
    }

    public function evaluarCompetencia($id_competencia, $valor)
    {
        try {
            $competencia = CuestionarioCompetenciaEvDesempeno::find($id_competencia);
            $competencia->update([
                'calificacion_competencia' => $valor,
                'estatus_calificado' => true,
            ]);

            $this->alertaGuardadoCorrecto();
            $this->buscarCompetencias();
        } catch (\Throwable $th) {
            $this->alertaGuardadoIncorrecto();
            $this->buscarCompetencias();
        }
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
