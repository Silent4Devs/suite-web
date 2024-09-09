<?php

namespace App\Livewire;

use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\EscalasMedicionObjetivos;
use App\Models\EvaluacionDesempeno;
use App\Models\EvidenciaObjCuestionarioEvDesempeno;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CuestionarioEvaluacionDesempenoObjetivos extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    //Basicos
    public $evaluador;

    public $id_evaluacion;

    public $id_evaluado;

    public $id_periodo;

    public $periodo_seleccionado = 0;
    // public $array_periodos;

    public $autoevaluacion = false;

    //Traer datos de la evaluación
    public $evaluacion;

    public $evaluado;

    public $objetivos_evaluado;

    public $objetivos_autoevaluado;

    public $obj_evidencias = [];

    public $calificacion_escala = [];

    public $calificacion_autoescala = [];

    public $autoevaluacion_colors = [];

    public $evaluacion_colors = [];

    //Campos para validación dependiendo de lo que el evaluador vaya a evaluar
    public $validacion_objetivos_evaluador;

    public $escalas;

    public $conducta;

    public $file = null;

    public $id_obj_arch;

    public $extension_arch;

    public $archivo_mostrado;

    public $porcentajeCalificado;

    //Se emite un evento que el livewire principal va a escuchar gracias a listeners
    public function sendDataToParent()
    {
        //Enviamos el progreso para que el livewire principal haga la validación para terminar la evaluación
        $this->dispatch('dataFromChild1', dataFromChild1: $this->porcentajeCalificado);
    }

    public function mount($id_evaluacion, $id_evaluado, $id_periodo)
    {
        $this->evaluador = User::getCurrentUser()->empleado;

        $this->id_evaluacion = $id_evaluacion;
        $this->id_evaluado = $id_evaluado;
        $this->id_periodo = $id_periodo;

        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);
        $this->evaluado = $this->evaluacion->evaluados->find($this->id_evaluado);
        // $this->cuestionarioSecciones();
        if ($this->evaluacion->activar_objetivos == true) {
            $this->buscarObjetivos();
        }

        if ($this->evaluado->empleado->id == $this->evaluador->id) {
            $this->autoevaluacion = true;
        }

        $this->progresoEvaluacion();
    }

    public function render()
    {
        return view('livewire.cuestionario-evaluacion-desempeno-objetivos');
    }

    public function buscarObjetivos()
    {
        $this->escalas = EscalasMedicionObjetivos::get();

        $this->validacion_objetivos_evaluador = false;

        $busqueda_evaluador = $this->evaluado->evaluadoresObjetivos($this->id_periodo)->where('evaluador_desempeno_id', $this->evaluador->id)->first();
        $busqueda_autoevaluador = $this->evaluado->evaluadoresObjetivos($this->id_periodo)->where('evaluador_desempeno_id', $this->id_evaluado->evaluado_desempeno_id)->first();

        if ($busqueda_evaluador || $busqueda_autoevaluador) {
            $this->validacion_objetivos_evaluador = true;

            if ($busqueda_evaluador) {
                $this->objetivos_evaluado = $busqueda_evaluador->preguntasCuestionario->where('periodo_id', $this->id_periodo)->sortBy('id');
            }

            if ($busqueda_autoevaluador) {
                $this->objetivos_autoevaluado = $busqueda_autoevaluador->preguntasCuestionario->where('periodo_id', $this->id_periodo)->sortBy('id');
            }
        }

        foreach ($this->objetivos_evaluado as $key_objetivo => $obj_evld) {
            foreach ($obj_evld->evidencias_evaluado as $key_evidencia => $evid) {
                $this->obj_evidencias[$key_objetivo][$key_evidencia] = [
                    'id' => $evid['id'],
                    'id_objetivo' => $evid['id_objetivo'],
                    'pregunta_cuest_obj_ev_des_id' => $evid['pregunta_cuest_obj_ev_des_id'],
                    'nombre_archivo' => $evid['nombre_archivo'],
                    'comentarios' => $evid['comentarios'],
                ];
            }

            foreach ($this->objetivos_evaluado as $obj_evld) {
                $infoObjetivo = $obj_evld->infoObjetivo;

                // Initialize with default values
                $this->calificacion_escala[$infoObjetivo->id] = 'Sin evaluar';
                $this->evaluacion_colors[$infoObjetivo->id.'-tx-color'] = $infoObjetivo->escalas[0]->color;

                $currentCondition = null; // Track the currently assigned condition

                foreach ($infoObjetivo->escalas as $obj_esc) {
                    $conditionMet = $this->evaluateCondition($obj_evld, $obj_esc);

                    if ($conditionMet) {
                        // If the condition is met, update the assigned condition and values
                        $currentCondition = $obj_esc;
                        $this->setValues($infoObjetivo->id, $obj_esc->parametro, $obj_esc->color);
                    } elseif ($currentCondition !== null && $currentCondition->valor === $obj_esc->valor) {
                        // If a subsequent condition matches the current condition's value, update the assigned condition and values
                        $currentCondition = $obj_esc;
                        $this->setValues($infoObjetivo->id, $obj_esc->parametro, $obj_esc->color);
                    }
                }
            }

            foreach ($this->objetivos_autoevaluado as $key_objetivo => $obj_evld) {
                $this->calificacion_autoescala[$obj_evld->infoObjetivo->id] = 'Sin evaluar';
                foreach ($obj_evld->infoObjetivo->escalas as $obj_esc) {
                    switch ($obj_esc->condicion) {
                        case '1':
                            if (
                                $obj_evld->calificacion_objetivo <
                                $obj_esc->valor
                            ) {
                                $this->calificacion_autoescala[$obj_evld->id] = $obj_esc->parametro;
                                $this->autoevaluacion_colors[$obj_evld->id.'-bg-color'] = $this->hexToRgba($obj_esc->color);
                                $this->autoevaluacion_colors[$obj_evld->id.'-tx-color'] = $obj_esc->color;
                            }
                            break;
                        case '2':
                            if (
                                $obj_evld->calificacion_objetivo <=
                                $obj_esc->valor
                            ) {
                                $this->calificacion_autoescala[$obj_evld->id] = $obj_esc->parametro;
                                $this->autoevaluacion_colors[$obj_evld->id.'-bg-color'] = $this->hexToRgba($obj_esc->color);
                                $this->autoevaluacion_colors[$obj_evld->id.'-tx-color'] = $obj_esc->color;
                                // dd($this->calificacion_autoescala);
                            }
                            break;
                        case '3':
                            if (
                                $obj_evld->calificacion_objetivo ==
                                $obj_esc->valor
                            ) {
                                $this->calificacion_autoescala[$obj_evld->id] = $obj_esc->parametro;
                                $this->autoevaluacion_colors[$obj_evld->id.'-bg-color'] = $this->hexToRgba($obj_esc->color);
                                $this->autoevaluacion_colors[$obj_evld->id.'-tx-color'] = $obj_esc->color;
                            }
                            break;
                        case '4':
                            if (
                                $obj_evld->calificacion_objetivo >
                                $obj_esc->valor
                            ) {
                                $this->calificacion_autoescala[$obj_evld->id] = $obj_esc->parametro;
                                $this->autoevaluacion_colors[$obj_evld->id.'-bg-color'] = $this->hexToRgba($obj_esc->color);
                                $this->autoevaluacion_colors[$obj_evld->id.'-tx-color'] = $obj_esc->color;
                            }
                            break;
                        case '5':
                            if (
                                $obj_evld->calificacion_objetivo >=
                                $obj_esc->valor
                            ) {
                                $this->calificacion_autoescala[$obj_evld->id] = $obj_esc->parametro;
                                $this->autoevaluacion_colors[$obj_evld->id.'-bg-color'] = $this->hexToRgba($obj_esc->color);
                                $this->autoevaluacion_colors[$obj_evld->id.'-tx-color'] = $obj_esc->color;
                            }
                            break;
                        default:
                            $this->calificacion_autoescala[$obj_evld->infoObjetivo->id] = $obj_evld->infoObjetivo->escalas[0]->parametro;
                            $this->autoevaluacion_colors[$obj_evld->id.'-bg-color'] = $this->hexToRgba($obj_esc->color);
                            $this->autoevaluacion_colors[$obj_evld->id.'-tx-color'] = $obj_esc->color;
                            break;
                    }
                }
            }
        }
    }

    private function evaluateCondition($obj_evld, $obj_esc)
    {
        switch ($obj_esc->condicion) {
            case '1':
                return $obj_evld->calificacion_objetivo < $obj_esc->valor;
            case '2':
                return $obj_evld->calificacion_objetivo <= $obj_esc->valor;
            case '3':
                return $obj_evld->calificacion_objetivo == $obj_esc->valor;
            case '4':
                return $obj_evld->calificacion_objetivo > $obj_esc->valor;
            case '5':
                return $obj_evld->calificacion_objetivo >= $obj_esc->valor;
            default:
                return true; // Default condition, always true
        }
    }

    private function setValues($objetivoId, $parametro, $color)
    {
        $this->calificacion_escala[$objetivoId] = $parametro;
        $this->evaluacion_colors[$objetivoId.'-tx-color'] = $color;
    }

    public function evaluarObjetivo($id_objetivo, $valor)
    {
        try {
            $objetivo = CuestionarioObjetivoEvDesempeno::find($id_objetivo);
            $objetivo->update([
                'calificacion_objetivo' => $valor,
                'estatus_calificado' => true,
            ]);

            $this->alertaGuardadoCorrecto('Respuesta');
            $this->buscarObjetivos();
            $this->progresoEvaluacion();
        } catch (\Throwable $th) {
            $this->alertaGuardadoIncorrecto();
            $this->buscarObjetivos();
        }
    }

    public function updatedFile()
    {
        try {
            $ruta_evidencias = 'public/evaluaciones_desempeno/evaluacion/'.$this->evaluacion->id.'/evidencia/objetivo/'.$this->id_obj_arch.'/evaluado'.'/'.$this->evaluado->id;

            if (! Storage::exists($ruta_evidencias)) {
                Storage::makeDirectory($ruta_evidencias, 0775, true);
            }

            $originalFilename = $this->file->getClientOriginalName();

            $this->file->storeAs($ruta_evidencias, $originalFilename);

            EvidenciaObjCuestionarioEvDesempeno::create([
                'pregunta_cuest_obj_ev_des_id' => $this->id_obj_arch,
                'nombre_archivo' => $originalFilename,
            ]);

            $this->file = null;

            $this->alertaGuardadoCorrecto('Evidencia');
            $this->buscarObjetivos();
        } catch (\Throwable $th) {
            $this->alertaGuardadoIncorrecto();
            $this->buscarObjetivos();
        }
    }

    public function comentarioObjetivo($evidencia_id, $valor)
    {
        try {
            $obj_com = EvidenciaObjCuestionarioEvDesempeno::findOrFail($evidencia_id);

            $obj_com->update([
                'comentarios' => $valor,
            ]);
            $this->alertaGuardadoCorrecto('Comentario');
        } catch (\Throwable $th) {
            $this->alertaGuardadoIncorrecto();
        }
    }

    public function mostrarArchivo($id_archivo_obj, $id_archivo_mostrar)
    {
        $archivo = EvidenciaObjCuestionarioEvDesempeno::findOrFail($id_archivo_mostrar);

        $ruta_evidencias =
            'storage/evaluaciones_desempeno/evaluacion/'.$this->evaluacion->id.'/evidencia/objetivo/'.$id_archivo_obj.'/evaluado'.'/'.$this->evaluado->id.'/'.$archivo->nombre_archivo;

        $extension = pathinfo($ruta_evidencias, PATHINFO_EXTENSION);

        $this->archivo_mostrado = $ruta_evidencias;

        switch ($extension) {
            case 'pdf':
                $this->extension_arch = $extension;
                break;
            case 'jpg':
                $this->extension_arch = $extension;
                break;
            case 'jpeg':
                $this->extension_arch = $extension;
                break;
            case 'png':
                $this->extension_arch = $extension;
                break;
            case 'xls':
                $this->extension_arch = $extension;
                break;
            case 'xlsx':
                $this->extension_arch = $extension;
                break;
            case 'docx':
                $this->extension_arch = $extension;
                break;
            default:
                $this->extension_arch = 'Desconocido';
                break;
        }
    }

    public function asignarObjArchivo($id_obj)
    {
        $this->id_obj_arch = $id_obj;
    }

    public function aplicaObjetivo($obj_apl_id, $valor)
    {
        try {
            $objetivo = CuestionarioObjetivoEvDesempeno::find($obj_apl_id);
            $objetivo->update([
                'aplicabilidad' => $valor,
            ]);

            $this->alertaGuardadoCorrecto('Estatus');
            $this->buscarObjetivos();
            $this->sendDataToParent();
        } catch (\Throwable $th) {
            $this->alertaGuardadoIncorrecto();
            $this->buscarObjetivos();
        }
    }

    public function alertaGuardadoCorrecto($alerta)
    {
        $this->alert('success', $alerta.' Guardada', [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'text' => 'La '.$alerta.' se ha guardado correctamente.',
        ]);
        $this->sendDataToParent();
    }

    public function alertaGuardadoIncorrecto()
    {
        $this->alert('error', 'Error', [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'text' => 'Ha ocurrido un error al guardar.',
        ]);
    }

    public function hexToRgba($hex)
    {
        $hex = str_replace('#', '', $hex);

        $red = hexdec(substr($hex, 0, 2));
        $green = hexdec(substr($hex, 2, 2));
        $blue = hexdec(substr($hex, 4, 2));

        return "rgba($red, $green, $blue, 0.2)";
    }

    // public function cuestionarioSecciones()
    // {
    //     foreach ($this->evaluacion->periodos as $key => $periodo) {
    //         $this->array_periodos[$key] = [
    //             "id_periodo" => $periodo->id,
    //             "nombre_evaluacion" => $periodo->nombre_evaluacion,
    //             "fecha_inicio" => $periodo->fecha_inicio,
    //             "fecha_fin" => $periodo->fecha_fin,
    //             "habilitado" => $periodo->habilitado,
    //             "finalizado" => $periodo->finalizado,
    //         ];
    //     }
    // }

    public function progresoEvaluacion()
    {
        $nPreguntas = $this->objetivos_evaluado->count();
        $contestadas = $this->objetivos_evaluado->where('estatus_calificado', true)->count();
        $this->porcentajeCalificado = round((($contestadas / $nPreguntas) * 100), 2);

        $this->sendDataToParent();
    }

    public function cambiarSeccion($llave)
    {
        $this->periodo_seleccionado = $llave;
    }
}
