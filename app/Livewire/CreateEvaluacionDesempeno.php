<?php

namespace App\Livewire;

use App\Mail\CreacionEvaluacionDesempenoMailable;
use App\Models\Area;
use App\Models\CatalogoCompetenciasEvDesempeno;
use App\Models\CatalogoObjetivosEvDesempeno;
use App\Models\ConductasCompCuestionarioEvDesempenos;
use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\Empleado;
use App\Models\EscalasEvaluacionDesempeno;
use App\Models\EscalasMedicionObjetivos;
use App\Models\EscalasObjCuestionarioEvDesempeno;
use App\Models\EvaluacionDesempeno;
use App\Models\EvaluadoresEvaluacionCompetenciasDesempeno;
use App\Models\EvaluadoresEvaluacionObjetivosDesempeno;
use App\Models\EvaluadosEvaluacionDesempeno;
use App\Models\ListaInformativa;
use App\Models\PeriodosEvaluacionDesempeno;
use App\Models\PeriodoCargaObjetivos;
use App\Models\RH\GruposEvaluado;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateEvaluacionDesempeno extends Component
{
    use LivewireAlert;

    public $paso = 1;

    // Variables primer paso
    public $nombre_evaluacion = null;

    public $descripcion_evaluacion = null;

    public $activar_objetivos = false;

    public $porcentaje_objetivos = 50;

    public $activar_competencias = false;

    public $porcentaje_competencias = 50;

    public $datosPaso1;

    // Variables segundo paso
    public $periodo_evaluacion;

    public $mensual = false;

    public $bimestral = false;

    public $trimestral = false;

    public $semestral = false;

    public $anualmente = false;

    public $abierta = false;

    // Arreglo para recopilar periodos
    public $arreglo_periodos = [];

    public $datosPaso2;

    // Variables paso 3
    public $select_evaluados = 'toda';

    public $areas;

    public $empleados;

    public $grupos;

    public $evaluados_areas = '';

    public $evaluados_manual;

    public $empleados_seleccionados = [];

    public $evaluados_grupos = '';

    public $nombreGrupo = '';

    public $empleados_grupo;

    // verificacion objetivos y competencias
    public $hayEmpleadosSinCompetencias = false;

    public $totalEmpleadosSinCompetencias = 0;

    public $listaEmpleadosSinCompetencias;

    public $listaIDSinCompetencias;

    public $hayEmpleadosSinObjetivos = false;

    public $totalEmpleadosSinObjetivos = 0;

    public $listaEmpleadosSinObjetivos;

    public $listaIDSinObjetivos;

    public $hayEmpleadosObjetivosPendiente = false;

    public $totalEmpleadosObjetivosPendiente = 0;

    public $listaEmpleadosObjetivosPendiente;

    public $listaIDObjetivosPendiente;

    public $bloquear_evaluacion = true;

    // Variables paso 4
    public $evaluados;

    public $array_evaluados;

    public $array_evaluadores;

    public $array_porcentaje_evaluadores;

    public $colaboradores = [];

    public $periodos_creados_borrador = [];

    public $periodo_carga_obj = null;

    public function hydrate()
    {
        $this->dispatch('select2');
    }

    public function mount()
    {
        // Obtén la colección de empleados y conviértela a un array con solo id y name
        $empleadosCollection = Empleado::getIdNameAll();

        // Utiliza pluck para obtener solo los campos necesarios
        $this->empleados = $empleadosCollection->map(function ($empleado) {
            return [
                'id' => $empleado['id'],
                'name' => $empleado['name'],
                'foto' => $empleado['foto'],
            ];
        })->sortBy('name')->values()->toArray();

        $this->areas = Area::getIdNameAll()->sortBy('area');
        $this->grupos = GruposEvaluado::getAll();

        $this->periodo_carga_obj = PeriodoCargaObjetivos::first();
    }

    public function render()
    {
        return view('livewire.create-evaluacion-desempeno');
    }

    public function retroceder()
    {
        $this->paso--;
    }

    public function primerPaso()
    {
        // Validación de nombre de la evaluación
        if (empty($this->nombre_evaluacion)) {
            $this->alert('warning', 'Nombre de Evaluación Requerido', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Debe proporcionar un nombre para la evaluación.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);

            return;
        }

        // Validación de selección de objetivos y competencias
        if (! $this->activar_objetivos && ! $this->activar_competencias) {
            $this->alert('warning', 'Selección Requerida', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Debe seleccionar al menos una opción: objetivos, competencias, o ambos.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);

            return;
        }

        // Validación de porcentajes
        if ($this->activar_objetivos && $this->activar_competencias) {
            if (($this->porcentaje_objetivos + $this->porcentaje_competencias) != 100) {
                $this->alert('warning', 'Porcentaje Incorrecto', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'La suma de los porcentajes de objetivos y competencias debe ser igual a 100%.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entendido',
                    'timerProgressBar' => true,
                ]);

                return;
            }

            if ($this->porcentaje_objetivos == 0 || $this->porcentaje_competencias == 0) {
                $this->alert('warning', 'Porcentaje Incorrecto', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'Los porcentajes de objetivos y competencias no pueden ser 0 si ambos están seleccionados.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entendido',
                    'timerProgressBar' => true,
                ]);

                return;
            }
        } elseif ($this->activar_objetivos && ! $this->activar_competencias) {
            if ($this->porcentaje_objetivos != 100) {
                $this->alert('warning', 'Porcentaje Incorrecto', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'El porcentaje de objetivos debe ser igual a 100%.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entendido',
                    'timerProgressBar' => true,
                ]);

                return;
            }
        } elseif (! $this->activar_objetivos && $this->activar_competencias) {
            if ($this->porcentaje_competencias != 100) {
                $this->alert('warning', 'Porcentaje Incorrecto', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'El porcentaje de competencias debe ser igual a 100%.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entendido',
                    'timerProgressBar' => true,
                ]);

                return;
            }
        }

        // Establecer porcentaje a 0 si no está activado
        if (! $this->activar_objetivos) {
            $this->porcentaje_objetivos = 0;
        }
        if (! $this->activar_competencias) {
            $this->porcentaje_competencias = 0;
        }

        // Guardar los datos del primer paso
        $this->datosPaso1 = [
            'nombre' => $this->nombre_evaluacion,
            'descripcion' => $this->descripcion_evaluacion,
            'activar_objetivos' => $this->activar_objetivos,
            'porcentaje_objetivos' => $this->porcentaje_objetivos,
            'activar_competencias' => $this->activar_competencias,
            'porcentaje_competencias' => $this->porcentaje_competencias,
        ];

        // Avanzar al siguiente paso
        $this->paso = 2;
    }

    public function seleccionPeriodo($periodo)
    {
        $this->arreglo_periodos = [];
        $this->periodo_evaluacion = $periodo;

        // Desactivar todos los períodos
        // $this->mensual = $this->bimestral = $this->trimestral = $this->semestral = $this->anualmente = $this->abierta = false;

        // Configurar el período seleccionado
        $cantidad_periodos = 0;
        // if ($valor) {
        switch ($periodo) {
            case 'mensual':
                // $this->mensual = true;
                $cantidad_periodos = 12;
                break;
            case 'bimestral':
                // $this->bimestral = true;
                $cantidad_periodos = 6;
                break;
            case 'trimestral':
                // $this->trimestral = true;
                $cantidad_periodos = 4;
                break;
            case 'semestral':
                // $this->semestral = true;
                $cantidad_periodos = 2;
                break;
            case 'anualmente':
            case 'abierta':
                // $this->anualmente = ($periodo == 'anualmente');
                // $this->abierta = ($periodo == 'abierta');
                $cantidad_periodos = 1;
                break;
            default:
                // Periodo no válido
                return;
        }

        for ($i = 1; $i <= $cantidad_periodos; $i++) {
            $this->arreglo_periodos[] = [
                'nombre_evaluacion' => 'T'.$i,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'habilitar' => ($i === 1), // Solo el primer periodo habilitado
            ];
        }
        // }
    }

    public function agregarPeriodo()
    {
        $numeroDePeriodos = count($this->arreglo_periodos) + 1; // Obtener el número actual de períodos y agregar 1

        $this->arreglo_periodos[] = [
            'nombre_evaluacion' => 'T'.$numeroDePeriodos,
            'fecha_inicio' => null,
            'fecha_fin' => null,
            'habilitar' => false, // Solo el primer periodo habilitado
        ];
    }

    public function eliminarPeriodo($index)
    {
        if (isset($this->arreglo_periodos[$index])) {
            unset($this->arreglo_periodos[$index]);
            $this->arreglo_periodos = array_values($this->arreglo_periodos); // Reindexar el array
        }
    }

    public function segundoPaso()
    {
        $this->datosPaso2 = [];

        foreach ($this->arreglo_periodos as $key => $ap) {
            $fechaInicio = $ap['fecha_inicio'];
            $fechaFin = $ap['fecha_fin'];
            $habilitar = $key === 0;

            // Validar que la primera posición tenga fechas
            if ($key === 0 && (empty($fechaInicio) || empty($fechaFin))) {
                // Emitir alerta si faltan las fechas
                $this->alert('warning', 'Faltan fechas en el primer período', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'Por favor complete las fechas de inicio y fin en el primer período.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);

                return;
            }

            // Validar que la fecha de inicio no sea posterior a la fecha de fin
            if (! empty($fechaInicio) && ! empty($fechaFin) && $fechaInicio > $fechaFin) {
                // Emitir alerta si la fecha de inicio es posterior a la fecha de fin
                $this->alert('warning', 'Fechas inválidas', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'La fecha de inicio no puede ser posterior a la fecha de fin.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);

                return;
            }

            $this->datosPaso2[] = [
                'nombre_evaluacion' => $ap['nombre_evaluacion'],
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'habilitar' => $habilitar,
            ];
        }

        $this->paso = 3;
    }

    public function seleccionarEvaluados($valor)
    {
        $this->select_evaluados = $valor;
    }

    public function guardarGrupo()
    {
        // Validar que los campos no estén vacíos

        // Si pasó la validación, procedemos a crear el grupo
        $grupo = GruposEvaluado::create([
            'nombre' => $this->nombreGrupo,
        ]);

        $grupo->empleados()->sync($this->empleados_grupo);

        // Mostrar alerta de éxito
        $this->alert('success', 'Grupo Guardado', [
            'position' => 'center',
            'timer' => 6000,
            'toast' => false,
            'text' => 'El grupo ha sido guardado correctamente.',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);

        // Limpiar los campos después de guardar
        $this->nombreGrupo = '';
        $this->empleados_grupo = null;
        $this->grupos = GruposEvaluado::getAll();
    }

    public function asignacionEmpleados($id_empleado, $name_empleado)
    {
        // Verificar si el empleado ya está registrado
        $existe = collect($this->empleados_seleccionados)->firstWhere('id', $id_empleado);

        if ($existe) {
            // Mostrar alerta si el empleado ya está registrado
            $this->alert('warning', 'Empleado ya registrado', [
                'text' => "El empleado {$name_empleado} ya se encuentra asignado.",
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3000,
            ]);
        } else {
            // Registrar al empleado si no existe
            $this->empleados_seleccionados[] = [
                'id' => $id_empleado,
                'name' => $name_empleado,
            ];

            // Mostrar alerta de éxito
            $this->alert('success', 'Empleado asignado', [
                'text' => "El empleado {$name_empleado} ha sido asignado correctamente.",
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3000,
            ]);
        }
    }

    public function desasignarColaborador($key)
    {
        unset($this->empleados_seleccionados[$key]);
    }

    public function tercerPaso()
    {
        $evld = [];
        switch ($this->select_evaluados) {
            case 'toda':
                $ev_query = Empleado::getIDaltaAll();
                $evld = $ev_query->pluck('id');
                // dd($evld);
                break;

            case 'areas':
                $ev_query = Area::with('totalIDEmpleados')->find($this->evaluados_areas);
                $evld = $ev_query->totalIDEmpleados->pluck('id');
                break;

            case 'manualmente':
                $ev_query = Empleado::getIDaltaAll()->sortBy('name');

                foreach ($this->empleados_seleccionados as $emp_sel) {
                    $evld[] = intval($emp_sel['id']);
                }

                break;

            case 'grupo':
                $ev_query = GruposEvaluado::with('empleadosEvaluacion')->find($this->evaluados_grupos);
                $evld = $ev_query->empleados->pluck('id');
                break;

            default:

                break;
        }

        $this->asignarEvaluadoresAEvaluados($evld);

        $this->paso = 4;
    }

    public function cuartoPaso()
    {
        if (! ($this->bloquear_evaluacion)) {
            // Verificar que la suma de los porcentajes de los evaluadores sea igual a 100% para cada evaluado

            // Crear la evaluación de desempeño
            $evaluacion = EvaluacionDesempeno::create([
                'nombre' => $this->datosPaso1['nombre'],
                'descripcion' => $this->datosPaso1['descripcion'],
                'activar_objetivos' => $this->datosPaso1['activar_objetivos'],
                'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'],
                'activar_competencias' => $this->datosPaso1['activar_competencias'],
                'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'],
                'tipo_periodo' => $this->periodo_evaluacion,
                'estatus' => 1,
                'autor_id' => User::getCurrentUser()->empleado->id,
            ]);

            $escalas = EscalasMedicionObjetivos::get();

            foreach ($escalas as $escala) {
                EscalasEvaluacionDesempeno::create([
                    'evaluacion_desempeno_id' => $evaluacion->id,
                    'parametro' => $escala->parametro,
                    'valor' => $escala->valor,
                    'color' => $escala->color,
                ]);
            }

            $periodos_creados = [];
            foreach ($this->datosPaso2 as $p) {
                if (! empty($p['nombre_evaluacion'])) {
                    $periodos_creados[] = PeriodosEvaluacionDesempeno::create([
                        'evaluacion_desempeno_id' => $evaluacion->id,
                        'nombre_evaluacion' => $p['nombre_evaluacion'],
                        'fecha_inicio' => $p['fecha_inicio'],
                        'fecha_fin' => $p['fecha_fin'],
                        'habilitado' => $p['habilitar'],
                    ]);
                }
            }

            foreach ($this->array_porcentaje_evaluadores as $key => $porcentajes) {
                $suma_porcentajes_objetivos = array_sum($porcentajes['porcentaje_evaluador_objetivos'] ?? []);
                $suma_porcentajes_competencias = array_sum($porcentajes['porcentaje_evaluador_competencias'] ?? []);

                if ($evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
                    if ($suma_porcentajes_objetivos !== 100 || $suma_porcentajes_competencias !== 100) {
                        return $this->mostrarErrorPorcentajes();
                    }
                } elseif ($evaluacion->activar_objetivos) {
                    if ($suma_porcentajes_objetivos !== 100) {
                        return $this->mostrarErrorPorcentajes();
                    }
                } elseif ($evaluacion->activar_competencias) {
                    if ($suma_porcentajes_competencias !== 100) {
                        return $this->mostrarErrorPorcentajes();
                    }
                }
            }

            foreach ($this->array_evaluados as $key => $evaluado) {
                $new_evaluado = EvaluadosEvaluacionDesempeno::create([
                    'evaluacion_desempeno_id' => $evaluacion->id,
                    'evaluado_desempeno_id' => $evaluado['id'],
                ]);

                foreach ($periodos_creados as $periodo) {
                    if ($evaluacion->activar_objetivos) {
                        // Autoevaluacion
                        EvaluadoresEvaluacionObjetivosDesempeno::create([
                            'evaluado_desempeno_id' => $new_evaluado->id,
                            'evaluador_desempeno_id' => $evaluado['id'],
                            'porcentaje_objetivos' => 0,
                            'periodo_id' => $periodo->id,
                        ]);

                        foreach ($this->array_evaluadores[$key]['evaluador_objetivos'] as $subkey => $evaluador) {
                            EvaluadoresEvaluacionObjetivosDesempeno::create([
                                'evaluado_desempeno_id' => $new_evaluado->id,
                                'evaluador_desempeno_id' => $evaluador,
                                'periodo_id' => $periodo->id,
                                'porcentaje_objetivos' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_objetivos'][$subkey],
                            ]);
                        }
                    }

                    if ($evaluacion->activar_competencias) {
                        // Autoevaluacion
                        EvaluadoresEvaluacionCompetenciasDesempeno::create([
                            'evaluado_desempeno_id' => $new_evaluado->id,
                            'evaluador_desempeno_id' => $evaluado['id'],
                            'porcentaje_competencias' => 0,
                            'periodo_id' => $periodo->id,
                        ]);

                        foreach ($this->array_evaluadores[$key]['evaluador_competencias'] as $subkey => $evaluador) {
                            EvaluadoresEvaluacionCompetenciasDesempeno::create([
                                'evaluado_desempeno_id' => $new_evaluado->id,
                                'evaluador_desempeno_id' => $evaluador,
                                'periodo_id' => $periodo->id,
                                'porcentaje_competencias' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_competencias'][$subkey],
                            ]);
                        }
                    }
                }
            }

            $evaluaciones_actuales = EvaluacionDesempeno::where('id', '!=', $evaluacion->id)
                ->where(function ($query) {
                    $query->where('estatus', 1)
                        ->orWhere('estatus', 3);
                })
                ->get();

            $evaluacion_activa = ! $evaluaciones_actuales->isEmpty();

            if ($evaluacion_activa) {
                $borrador_evaluacion = EvaluacionDesempeno::where('id', $evaluacion->id)->first();
                $borrador_evaluacion->update(['estatus' => 0]);
            } else {
                $this->crearCuestionario($evaluacion);

                $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', 'EvaluacionDesempeno')->first();

                if (isset($informados->participantes[0]) || isset($informados->usuarios[0])) {
                    $correos = [];

                    if (isset($informados->participantes[0])) {
                        foreach ($informados->participantes as $participante) {
                            $correos[] = $participante->empleado->email;
                        }
                    }

                    if (isset($informados->usuarios[0])) {
                        foreach ($informados->usuarios as $usuario) {
                            $correos[] = $usuario->usuario->email;
                        }
                    }

                    Mail::to($correos)->queue(new CreacionEvaluacionDesempenoMailable($evaluacion->nombre, $evaluacion->autor->name));
                }
            }

            return redirect(route('admin.rh.evaluaciones-desempeno.dashboard-general'));
        } else {
            $this->alert('warning', 'Colaboradores con Información Faltante', [
                'position' => 'center',
                'timer' => '600000',
                'toast' => false,
                'text' => 'Existen colaboradores con información faltante para crear la evaluación.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'Confirmar',
                'timerProgressBar' => true,
            ]);
        }
    }

    private function mostrarErrorPorcentajes()
    {
        $this->alert('error', 'La suma de los porcentajes de los evaluadores debe ser igual a 100% para cada evaluado', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Por favor, asegúrese de que los porcentajes estén correctamente distribuidos.',
        ]);

        return false;
    }

    public function crearCuestionario($evaluacion)
    {
        $empleados = Empleado::getIDaltaAll();

        $periodo = $evaluacion->periodos->first();
        // foreach ($evaluacion->periodos as $periodo) {
        foreach ($evaluacion->evaluados as $evaluado) {
            if ($evaluacion->activar_objetivos) {
                $obj_per = $empleados->find($evaluado->evaluado_desempeno_id)->objetivosPeriodo($this->periodo_evaluacion);

                foreach ($obj_per as $obj) {

                    $cat_obj = CatalogoObjetivosEvDesempeno::create([
                        'objetivo' => $obj->objetivo->nombre,
                        'descripcion_objetivo' => $obj->objetivo->descripcion_meta,
                        'KPI' => $obj->objetivo->KPI,
                        'tipo_objetivo' => $obj->objetivo->tipo->nombre,
                        'unidad_objetivo' => $obj->objetivo->metrica->definicion,
                        'valor_minimo_unidad_objetivo' => $obj->objetivo->metrica->valor_minimo,
                        'valor_maximo_unidad_objetivo' => $obj->objetivo->metrica->valor_maximo,
                    ]);

                    foreach ($obj->objetivo->escalas as $escala) {
                        if($escala->no_periodo == 1){
                            EscalasObjCuestionarioEvDesempeno::create(
                                [
                                    'objetivo_id' => $cat_obj->id,
                                    'condicion' => $escala->condicion,
                                    'parametro' => $escala->parametro,
                                    'valor' => $escala->valor,
                                    'color' => $escala->color,
                                    'no_periodo' => $escala->no_periodo
                                ]
                            );
                        }
                    }

                    $evlr_obj_periodo = $evaluado->evaluadoresObjetivos->where('periodo_id', $periodo->id);

                    foreach ($evlr_obj_periodo as $key => $evlr_obj) {
                        $new_objetivo = CuestionarioObjetivoEvDesempeno::create(
                            [
                                'objetivo_id' => $cat_obj->id,
                                'periodo_id' => $periodo->id,
                                'evaluacion_desempeno_id' => $evaluado->evaluacion_desempeno_id,
                                'evaluado_desempeno_id' => $evaluado->id,
                                'evaluador_desempeno_id' => $evlr_obj->id,
                                'calificacion_objetivo' => null,
                                'estatus_calificado' => false,
                            ]
                        );
                    }
                }
            }

            if ($evaluacion->activar_competencias) {
                $comp_per = $empleados->find($evaluado->evaluado_desempeno_id)->puestoRelacionado->competencias;

                foreach ($comp_per as $comp) {

                    $cat_comp = CatalogoCompetenciasEvDesempeno::create([
                        'competencia' => $comp->competencia->nombre,
                        'descripcion_competencia' => $comp->competencia->descripcion,
                        'tipo_competencia' => $comp->competencia->tipo->nombre,
                        'nivel_esperado' => $comp->nivel_esperado,
                    ]);

                    foreach ($comp->competencia->opciones as $opciones) {
                        ConductasCompCuestionarioEvDesempenos::create([
                            'competencia_id' => $cat_comp->id,
                            'definicion' => $opciones->definicion,
                            'ponderacion' => $opciones->ponderacion,
                        ]);
                    }

                    $evlr_comp_periodo = $evaluado->evaluadoresCompetencias->where('periodo_id', $periodo->id);

                    foreach ($evlr_comp_periodo as $key => $evlr_comp) {
                        $new_competencia = CuestionarioCompetenciaEvDesempeno::create([
                            'competencia_id' => $cat_comp->id,
                            'periodo_id' => $periodo->id,
                            'evaluacion_desempeno_id' => $evaluado->evaluacion_desempeno_id,
                            'evaluado_desempeno_id' => $evaluado->id,
                            'evaluador_desempeno_id' => $evlr_comp->id,
                            'calificacion_competencia' => null,
                            'estatus_calificado' => false,
                        ]);
                    }
                }
            }
        }
        // }
    }

    public function asignarEvaluadoresAEvaluados($evaluados)
    {
        // dump($evaluados);
        $this->array_evaluados = [];

        $emps = Empleado::select(
            'id',
            'name',
            'area_id',
            'supervisor_id',
            'puesto_id',
            'foto'
        )->with(['objetivos', 'children:id,name', 'supervisor:id,name', 'area:id,area', 'puestoRelacionado:id,puesto'])->where('estatus', 'alta')->whereNull('deleted_at')->get();
        // dump($emps);
        foreach ($emps as $emp) {
            $this->colaboradores[] =
                [
                    'id' => $emp->id,
                    'name' => $emp->name,
                ];
        }
        // dump('colaboradores');
        foreach ($evaluados as $key => $id_evaluado) {
            $eva = $emps->find($id_evaluado);
            $this->array_evaluados[$key] =
                [
                    'id' => $eva->id,
                    'name' => $eva->name,
                    'avatar' => $eva->avatar,
                    'area' => $eva->area->area,
                    'competencias' => $eva->competencias_asignadas,
                    'objetivos' => $eva->objetivos_asignados,
                    'supervisor_id' => $eva->supervisor->id ?? null,
                ];

            $this->listaEmpleadosSinCompetencias = collect();
            $this->listaIDSinCompetencias = collect();
            $this->listaEmpleadosSinObjetivos = collect();
            $this->listaIDSinObjetivos = collect();
            $this->listaEmpleadosObjetivosPendiente = collect();
            $this->listaIDObjetivosPendiente = collect();
            $this->totalEmpleadosSinCompetencias = 0;
            $this->totalEmpleadosSinObjetivos = 0;
            $this->totalEmpleadosObjetivosPendiente = 0;
            $this->hayEmpleadosSinCompetencias = false;
            $this->hayEmpleadosSinObjetivos = false;
            $this->hayEmpleadosObjetivosPendiente = false;
            // dd($this->array_evaluados);
            foreach ($this->array_evaluados as $evaluadoL) {
                // dd($evaluadoL['competencias']);
                if ($evaluadoL['competencias'] == 0) {
                    $this->hayEmpleadosSinCompetencias = true;
                    $this->totalEmpleadosSinCompetencias++;
                    $this->listaEmpleadosSinCompetencias->push(['name' => $evaluadoL['name'], 'avatar' => $evaluadoL['avatar']]);
                    $this->listaIDSinCompetencias->push($evaluadoL['id']);
                    // dd($this->listaEmpleadosSinCompetencias);
                } elseif ($evaluadoL['objetivos']['cuenta'] == 0) {
                    $this->hayEmpleadosSinObjetivos = true;
                    $this->totalEmpleadosSinObjetivos++;
                    $this->listaEmpleadosSinObjetivos->push(['name' => $evaluadoL['name'], 'avatar' => $evaluadoL['avatar']]);
                    $this->listaIDSinObjetivos->push($evaluadoL['id']);
                    // dd($this->listaEmpleadosSinObjetivos);
                } elseif ($evaluadoL['objetivos']['pendientes'] == true) {
                    $this->hayEmpleadosObjetivosPendiente = true;
                    $this->totalEmpleadosObjetivosPendiente++;
                    $this->listaEmpleadosObjetivosPendiente->push(['name' => $evaluadoL['name'], 'avatar' => $evaluadoL['avatar']]);
                    $this->listaIDObjetivosPendiente->push($evaluadoL['id']);
                    // dd($this->listaEmpleadosObjetivosPendiente);
                }
            }

            if ($this->totalEmpleadosSinCompetencias > 0) {
                $this->alert('warning', 'Sin Competencias', [
                    'position' => 'center',
                    'timer' => '600000',
                    'toast' => false,
                    'text' => 'Existen colaboradores sin competencias asignadas, no podra crear la evaluación si los colaboradores no tienen competencias para evaluar',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);
            } elseif ($this->totalEmpleadosSinObjetivos > 0) {
                $this->alert('warning', 'Sin Objetivos', [
                    'position' => 'center',
                    'timer' => '600000',
                    'toast' => false,
                    'text' => 'Existen colaboradores sin objetivos asignados, no podra crear la evaluación si los colaboradores no tienen objetivos para evaluar',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);
            } elseif ($this->totalEmpleadosObjetivosPendiente > 0) {
                $this->alert('warning', 'Objetivos Pendientes', [
                    'position' => 'center',
                    'timer' => '600000',
                    'toast' => false,
                    'text' => 'Existen colaboradores con objetivos asignados pendientes de revisar, no podra crear la evaluación si los colaboradores tienen objetivos con estatus pendientes.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Confirmar',
                    'timerProgressBar' => true,
                ]);
            } else {
                $this->bloquear_evaluacion = false;
            }

            if ($this->activar_objetivos == true && $this->activar_competencias == true) {

                $this->array_evaluadores[$key] = [
                    'evaluador_objetivos' => [isset($eva->supervisor->id) ? $eva->supervisor->id : ''],
                    'evaluador_competencias' => [isset($eva->supervisor->id) ? $eva->supervisor->id : ''],
                ];

                $this->array_porcentaje_evaluadores[$key] =
                    [
                        'porcentaje_evaluador_objetivos' => [100],
                        'porcentaje_evaluador_competencias' => [100],
                    ];
            } elseif ($this->activar_objetivos == true && $this->activar_competencias == false) {

                $this->array_evaluadores[$key] =
                    [
                        'evaluador_objetivos' => [isset($eva->supervisor->id) ? $eva->supervisor->id : ''],
                    ];

                $this->array_porcentaje_evaluadores[$key] = [
                    'porcentaje_evaluador_objetivos' => [100],
                ];
            } elseif ($this->activar_objetivos == false && $this->activar_competencias == true) {

                $this->array_evaluadores[$key] =
                    [
                        'evaluador_competencias' => [isset($eva->supervisor->id) ? $eva->supervisor->id : ''],
                    ];

                $this->array_porcentaje_evaluadores[$key] = [
                    'porcentaje_evaluador_competencias' => [100],
                ];
            }
        }
    }

    public function agregarEvaluadorObjetivos($posicion)
    {
        $this->array_evaluadores[$posicion]['evaluador_objetivos'][] = '';
        $this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_objetivos'][] = '';
    }

    public function removerEvaluadorObjetivos($posicion, $subposicion)
    {
        unset($this->array_evaluadores[$posicion]['evaluador_objetivos'][$subposicion]);
        $this->array_evaluadores = array_values($this->array_evaluadores);

        unset($this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_objetivos'][$subposicion]);
        $this->array_porcentaje_evaluadores = array_values($this->array_porcentaje_evaluadores);
    }

    public function agregarEvaluadorCompetencias($posicion)
    {
        $this->array_evaluadores[$posicion]['evaluador_competencias'][] = '';
        $this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_competencias'][] = '';
    }

    public function removerEvaluadorCompetencias($posicion, $subposicion)
    {
        unset($this->array_evaluadores[$posicion]['evaluador_competencias'][$subposicion]);
        $this->array_evaluadores = array_values($this->array_evaluadores);

        unset($this->array_porcentaje_evaluadores[$posicion]['porcentaje_evaluador_competencias'][$subposicion]);
        $this->array_porcentaje_evaluadores = array_values($this->array_porcentaje_evaluadores);
    }

    public function guardarBorrador()
    {
        // Validar antes de guardar
        if (! $this->validarPasoActual()) {
            if ($this->paso > 1) {
                $this->guardarHastaPasoAnterior();

                return redirect(route('admin.rh.evaluaciones-desempeno.dashboard-general'))->with('warning', 'Datos incompletos, borrador guardado hasta el paso anterior.');
            }
        }

        if ($this->validarPasoActual()) {
            // Comienza o continúa el borrador de la evaluación
            $evaluacion = EvaluacionDesempeno::create([
                'nombre' => $this->datosPaso1['nombre'] ?? $this->nombre_evaluacion,
                'descripcion' => $this->datosPaso1['descripcion'] ?? $this->descripcion_evaluacion ?? '',
                'activar_objetivos' => $this->datosPaso1['activar_objetivos'] ?? $this->activar_objetivos ?? 0,
                'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'] ?? $this->porcentaje_objetivos ?? 0,
                'activar_competencias' => $this->datosPaso1['activar_competencias'] ?? $this->activar_competencias ?? 0,
                'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'] ?? $this->porcentaje_competencias ?? 0,
                'tipo_periodo' => $this->periodo_evaluacion ?? null,
                'estatus' => 0, // Estatus de borrador
                'autor_id' => User::getCurrentUser()->empleado->id,
            ]);

            // Guardar el paso actual en la evaluación (por ejemplo, paso 1, 2, 3, etc.)
            // $evaluacion->update(['paso_actual' => $this->paso]);

            // Guardar los datos del paso actual
            switch ($this->paso) {
                case 1:
                    // Paso 1 ya guardado arriba
                    break;

                case 2:

                    $this->guardarPaso2($evaluacion);
                    break;

                case 3:
                    $this->guardarPaso2($evaluacion);
                    $this->guardarPaso3($evaluacion);
                    break;

                case 4:
                    $this->guardarPaso2($evaluacion);
                    // $this->guardarPaso3($evaluacion); //Se duplicaria
                    $this->guardarPaso4($evaluacion);
                    break;
            }

            // Redirigir a la vista de índice con un mensaje de éxito
            return redirect(route('admin.rh.evaluaciones-desempeno.dashboard-general'))
                ->with('success', 'Borrador guardado correctamente.');
        } else {
            $this->alert('warning', 'Datos Requeridos', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Debe llenar los campos de este paso para crear la evaluación.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function guardarHastaPasoAnterior()
    {
        // Comienza o continúa el borrador de la evaluación
        $evaluacion = EvaluacionDesempeno::create([
            'nombre' => $this->datosPaso1['nombre'] ?? $this->nombre_evaluacion,
            'descripcion' => $this->datosPaso1['descripcion'] ?? $this->descripcion_evaluacion ?? '',
            'activar_objetivos' => $this->datosPaso1['activar_objetivos'] ?? $this->activar_objetivos ?? 0,
            'porcentaje_objetivos' => $this->datosPaso1['porcentaje_objetivos'] ?? $this->porcentaje_objetivos ?? 0,
            'activar_competencias' => $this->datosPaso1['activar_competencias'] ?? $this->activar_competencias ?? 0,
            'porcentaje_competencias' => $this->datosPaso1['porcentaje_competencias'] ?? $this->porcentaje_competencias ?? 0,
            'tipo_periodo' => $this->periodo_evaluacion ?? null,
            'estatus' => 0, // Estatus de borrador
            'autor_id' => User::getCurrentUser()->empleado->id,
        ]);

        // Guardar los datos del paso actual
        switch ($this->paso) {
            case 1:
                // Paso 1 ya guardado arriba
                break;

            case 2:
                // Paso 2 ya guardado arriba
                break;

            case 3:
                $this->guardarPaso2($evaluacion);
                break;

            case 4:
                $this->guardarPaso2($evaluacion);
                $this->guardarPaso3($evaluacion);
                break;
        }

        // Redirigir a la vista de índice con un mensaje de éxito
        return redirect(route('admin.rh.evaluaciones-desempeno.dashboard-general'))
            ->with('success', 'Borrador guardado correctamente.');
    }

    private function validarPasoActual()
    {
        switch ($this->paso) {
            case 1:
                if (empty($this->nombre_evaluacion)) {
                    $this->alert('warning', 'Nombre de Evaluación Requerido', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'Debe proporcionar un nombre para la evaluación.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                }

                if (! $this->activar_objetivos && ! $this->activar_competencias) {
                    $this->alert('warning', 'Selección Requerida', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'Debe seleccionar al menos una opción: objetivos, competencias, o ambos.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                }

                if ($this->activar_objetivos && $this->activar_competencias) {
                    if (($this->porcentaje_objetivos + $this->porcentaje_competencias) != 100) {
                        $this->alert('warning', 'Porcentaje Incorrecto', [
                            'position' => 'center',
                            'timer' => 6000,
                            'toast' => false,
                            'text' => 'La suma de los porcentajes de objetivos y competencias debe ser igual a 100%.',
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'Entendido',
                            'timerProgressBar' => true,
                        ]);

                        return false;
                    }

                    if ($this->porcentaje_objetivos == 0 || $this->porcentaje_competencias == 0) {
                        $this->alert('warning', 'Porcentaje Incorrecto', [
                            'position' => 'center',
                            'timer' => 6000,
                            'toast' => false,
                            'text' => 'Los porcentajes de objetivos y competencias no pueden ser 0 si ambos están seleccionados.',
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'Entendido',
                            'timerProgressBar' => true,
                        ]);

                        return false;
                    }
                } elseif ($this->activar_objetivos && ! $this->activar_competencias) {
                    if ($this->porcentaje_objetivos != 100) {
                        $this->alert('warning', 'Porcentaje Incorrecto', [
                            'position' => 'center',
                            'timer' => 6000,
                            'toast' => false,
                            'text' => 'El porcentaje de objetivos debe ser igual a 100%.',
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'Entendido',
                            'timerProgressBar' => true,
                        ]);

                        return false;
                    }
                    $this->porcentaje_competencias = 0;
                } elseif (! $this->activar_objetivos && $this->activar_competencias) {
                    if ($this->porcentaje_competencias != 100) {
                        $this->alert('warning', 'Porcentaje Incorrecto', [
                            'position' => 'center',
                            'timer' => 6000,
                            'toast' => false,
                            'text' => 'El porcentaje de competencias debe ser igual a 100%.',
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'Entendido',
                            'timerProgressBar' => true,
                        ]);

                        return false;
                    }
                    $this->porcentaje_objetivos = 0;
                }
                break;

            case 2:
                $this->segundoPaso();
                $this->paso--; // Se reduce porque permanece en el mismo paso y segundoPaso() lo aumenta en 1
                if (empty($this->datosPaso2)) {
                    $this->alert('warning', 'Debe seleccionar un periodo de evaluación.', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'Debe seleccionar un periodo de evaluación.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                }

                if (empty($this->datosPaso2[0]['fecha_inicio']) || empty($this->datosPaso2[0]['fecha_fin'])) {
                    $this->alert('warning', 'Fechas de evaluación requeridas', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'Debe proporcionar las fechas de inicio y fin para la evaluación.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                }

                if ($this->datosPaso2[0]['fecha_inicio'] > $this->datosPaso2[0]['fecha_fin']) {
                    $this->alert('warning', 'Fechas de evaluación inválidas', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'La fecha de inicio no puede ser posterior a la fecha de fin.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                }
                break;

            case 3:
                $this->segundoPaso();
                $this->paso--; // Se reduce porque permanece en el mismo paso y segundoPaso() lo aumenta en 1
                $this->tercerPaso();
                $this->paso--; // Se reduce porque permanece en el mismo paso y segundoPaso() lo aumenta en 1
                if (empty($this->array_evaluados)) {
                    $this->alert('warning', 'Debe seleccionar a los colaboradres que seran evaluados.', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'Se deberan seleccionar los colaboradores que seran evaluados con esta evaluación.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                } else {
                    $this->alert('warning', 'Debe seleccionar un publico objetivo para la evaluación.', [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => false,
                        'text' => 'Se debe seleccionar el publico que realizara la evaluación.',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Entendido',
                        'timerProgressBar' => true,
                    ]);

                    return false;
                }
                break;

            case 4:
                // Agrega las validaciones del cuarto paso aquí
                break;
        }

        return true;
    }

    private function guardarPaso2($evaluacion)
    {
        if (! empty($this->periodo_evaluacion)) {
            $evaluacion->update(['tipo_periodo' => $this->periodo_evaluacion]);

            foreach ($this->datosPaso2 as $p) {
                if (! empty($p['nombre_evaluacion'])) {
                    $this->periodos_creados_borrador[] = PeriodosEvaluacionDesempeno::create(
                        [
                            'evaluacion_desempeno_id' => $evaluacion->id,
                            'nombre_evaluacion' => $p['nombre_evaluacion'],
                            'fecha_inicio' => $p['fecha_inicio'],
                            'fecha_fin' => $p['fecha_fin'],
                            'habilitado' => $p['habilitar'],
                        ]
                    );
                }
            }
        }
    }

    private function guardarPaso3($evaluacion)
    {
        foreach ($this->array_evaluados as $evaluado) {
            EvaluadosEvaluacionDesempeno::updateOrCreate(
                ['evaluacion_desempeno_id' => $evaluacion->id, 'evaluado_desempeno_id' => $evaluado['id']],
                []
            );
        }
    }

    private function guardarPaso4($evaluacion)
    {
        foreach ($this->array_evaluados as $key => $evaluado) {
            $new_evaluado = EvaluadosEvaluacionDesempeno::create(
                [
                    'evaluacion_desempeno_id' => $evaluacion->id,
                    'evaluado_desempeno_id' => $evaluado['id'],
                ]
            );

            foreach ($this->periodos_creados_borrador as $p) {
                foreach ($this->array_evaluadores[$key]['evaluador_objetivos'] as $subkey => $evaluador) {
                    EvaluadoresEvaluacionObjetivosDesempeno::create(
                        [
                            'evaluado_desempeno_id' => $new_evaluado->id,
                            'evaluador_desempeno_id' => $evaluador,
                            'periodo_id' => $p->id,
                            'porcentaje_objetivos' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_objetivos'][$subkey],
                        ]
                    );
                }

                foreach ($this->array_evaluadores[$key]['evaluador_competencias'] as $subkey => $evaluador) {
                    EvaluadoresEvaluacionCompetenciasDesempeno::updateOrCreate(
                        [
                            'evaluado_desempeno_id' => $new_evaluado->id,
                            'evaluador_desempeno_id' => $evaluador,
                            'periodo_id' => $p['id'],
                            'porcentaje_competencias' => $this->array_porcentaje_evaluadores[$key]['porcentaje_evaluador_competencias'][$subkey],
                        ]
                    );
                }
            }
        }
    }

    public function repetirConsultaCompetencias()
    {
        foreach ($this->listaIDSinCompetencias as $IDsinComp) {

            $rev_emp_comp = Empleado::select(
                'id',
                'name',
                'area_id',
                'puesto_id',
            )->with(['area:id,area', 'puestoRelacionado:id,puesto'])
                ->where('estatus', 'alta')
                ->whereNull('deleted_at')
                ->where('empleados.id', $IDsinComp)
                ->first();
            if ($rev_emp_comp->competencias_asignadas > 0) {
                $this->listaEmpleadosSinCompetencias = $this->listaEmpleadosSinCompetencias->filter(function ($item) use ($rev_emp_comp) {
                    return $item !== $rev_emp_comp->name;
                });
            }
        }

        $this->totalEmpleadosSinCompetencias = $this->listaEmpleadosSinCompetencias->count();

        if ($this->totalEmpleadosSinCompetencias == 0) {
            $this->hayEmpleadosSinCompetencias = false;
        } else {
            $this->alert('warning', 'Sin Competencias', [
                'position' => 'center',
                'timer' => '600000',
                'toast' => false,
                'text' => 'Existen colaboradores sin competencias asignadas, no podra crear la evaluación si los colaboradores no tienen competencias para evaluar',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'Confirmar',
                'timerProgressBar' => true,
            ]);
        }

        if (
            $this->hayEmpleadosSinCompetencias == false &&
            $this->hayEmpleadosSinObjetivos == false &&
            $this->hayEmpleadosObjetivosPendiente == false
        ) {
            $this->bloquear_evaluacion = false;
        }
    }

    public function repetirConsultaObjetivos()
    {
        foreach ($this->listaIDSinObjetivos as $IDsinObj) {

            $rev_emp_obj = Empleado::select(
                'id',
                'name',
                'area_id',
                'puesto_id',
            )->with(['area:id,area', 'objetivos:id,objetivo_id,empleado_id'])
                ->where('estatus', 'alta')
                ->whereNull('deleted_at')
                ->where('empleados.id', $IDsinObj)
                ->first();
            if ($rev_emp_obj->objetivos_asignados['cuenta'] > 0) {
                $this->listaEmpleadosSinObjetivos = $this->listaEmpleadosSinObjetivos->filter(function ($item) use ($rev_emp_obj) {
                    return $item !== $rev_emp_obj->name;
                });
            }
        }
        $this->totalEmpleadosSinObjetivos = $this->listaEmpleadosSinObjetivos->count();

        if ($this->totalEmpleadosSinObjetivos == 0) {
            $this->hayEmpleadosSinObjetivos = false;
        } else {
            $this->alert('warning', 'Sin Objetivos', [
                'position' => 'center',
                'timer' => '600000',
                'toast' => false,
                'text' => 'Existen colaboradores sin objetivos asignados, no podra crear la evaluación si los colaboradores no tienen objetivos para evaluar',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'Confirmar',
                'timerProgressBar' => true,
            ]);
        }

        if (
            $this->hayEmpleadosSinCompetencias == false &&
            $this->hayEmpleadosSinObjetivos == false &&
            $this->hayEmpleadosObjetivosPendiente == false
        ) {
            $this->bloquear_evaluacion = false;
        }
    }

    public function repetirConsultaObjetivosPendientes()
    {
        foreach ($this->listaIDObjetivosPendiente as $IDObjPen) {

            $rev_emp_obj_pend = Empleado::select(
                'id',
                'name',
                'area_id',
                'puesto_id',
            )->with(['area:id,area', 'objetivos:id,objetivo_id,empleado_id'])
                ->where('estatus', 'alta')
                ->whereNull('deleted_at')
                ->where('empleados.id', $IDObjPen)
                ->first();

            if ($rev_emp_obj_pend->objetivos_asignados['pendientes'] == false) {
                $this->listaEmpleadosObjetivosPendiente = $this->listaEmpleadosObjetivosPendiente->filter(function ($item) use ($rev_emp_obj_pend) {
                    return $item !== $rev_emp_obj_pend->name;
                });
            }
        }
        $this->totalEmpleadosObjetivosPendiente = $this->listaEmpleadosObjetivosPendiente->count();

        if ($this->totalEmpleadosObjetivosPendiente == 0) {
            $this->hayEmpleadosObjetivosPendiente = false;
        } else {
            $this->alert('warning', 'Objetivos Pendientes', [
                'position' => 'center',
                'timer' => '600000',
                'toast' => false,
                'text' => 'Existen colaboradores con objetivos asignados pendientes de revisar, no podra crear la evaluación si los colaboradores tienen objetivos con estatus pendientes.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'Confirmar',
                'timerProgressBar' => true,
            ]);
        }

        if (
            $this->hayEmpleadosSinCompetencias == false &&
            $this->hayEmpleadosSinObjetivos == false &&
            $this->hayEmpleadosObjetivosPendiente == false
        ) {
            $this->bloquear_evaluacion = false;
        }
    }
}
