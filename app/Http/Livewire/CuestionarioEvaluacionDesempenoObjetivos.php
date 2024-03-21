<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\EscalasMedicionObjetivos;
use App\Models\EvaluacionDesempeno;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CuestionarioEvaluacionDesempenoObjetivos extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    //Basicos
    public $evaluador;
    public $id_evaluacion;
    public $id_evaluado;

    //Traer datos de la evaluación
    public $evaluacion;
    public $evaluado;
    public $objetivos_evaluado;

    //Campos para validación dependiendo de lo que el evaluador vaya a evaluar
    public $validacion_objetivos_evaluador;

    public $escalas;
    public $conducta;

    public $file;
    public $id_obj_arch;


    public function mount($id_evaluacion, $id_evaluado)
    {
        $this->evaluador = User::getCurrentUser()->empleado;

        $this->id_evaluacion = $id_evaluacion;
        $this->id_evaluado = $id_evaluado;
    }

    public function render()
    {
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        $this->evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);
        if ($this->evaluacion->activar_objetivos == true) {

            $this->buscarObjetivos();
        }

        return view('livewire.cuestionario-evaluacion-desempeno-objetivos');
    }

    public function buscarObjetivos()
    {
        $this->escalas = EscalasMedicionObjetivos::get();
        // dd($this->escalas);
        $this->validacion_objetivos_evaluador = false;

        foreach ($this->evaluado->evaluadoresObjetivos as $key => $evlr) {
            if ($evlr->evaluador_desempeno_id == $this->evaluador->id) {
                $this->validacion_objetivos_evaluador = true;

                $this->objetivos_evaluado = $evlr->preguntasCuestionario->sortBy('id');

                break;
            }
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

    public function updatedFile()
    {
        // dd($this->id_obj_arch, $this->file);

        $ruta_evidencias = 'public/evaluaciones_desempeno/evaluacion/' . $this->evaluacion->id . '/evidencia/objetivo/' . $this->id_obj_arch . '/evaluado' . '/' . $this->evaluado->id;

        if (!Storage::exists($ruta_evidencias)) {
            Storage::makeDirectory($ruta_evidencias, 0775, true);
        }

        $path = $this->file->store($ruta_evidencias);
        // Storage::put($ruta_evidencias . '/' . $this->file->getClientOriginalName(), file_get_contents($this->file));

        // if(){

        // }
    }

    public function asignarObjArchivo($id_obj)
    {
        $this->id_obj_arch = $id_obj;
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
