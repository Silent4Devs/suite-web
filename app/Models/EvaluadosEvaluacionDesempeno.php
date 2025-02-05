<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluadosEvaluacionDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evaluados_evaluacion_desempenos';

    protected $fillable = [
        'evaluacion_desempeno_id',
        'evaluado_desempeno_id',
        'estatus_evaluado',
    ];

    protected $appends = ['nombres_evaluadores', 'cuenta_evaluaciones', 'cuenta_evaluaciones_completadas', 'calificaciones_objetivos_evaluado', 'calificaciones_competencias_evaluado'];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'evaluado_desempeno_id', 'id')->select('id', 'name', 'email', 'area_id', 'puesto_id', 'foto', 'estatus', 'supervisor_id');
    }

    public function evaluadoresObjetivos($id_periodo = null)
    {
        if (empty($id_periodo)) {
            return $this->hasMany(EvaluadoresEvaluacionObjetivosDesempeno::class, 'evaluado_desempeno_id', 'id')->orderBy('id');
        } else {
            return $this->hasMany(EvaluadoresEvaluacionObjetivosDesempeno::class, 'evaluado_desempeno_id', 'id')->where('periodo_id', $id_periodo)->orderBy('id')->get();
        }
    }

    public function evaluadoresCompetencias($id_periodo = null)
    {
        if (empty($id_periodo)) {
            return $this->hasMany(EvaluadoresEvaluacionCompetenciasDesempeno::class, 'evaluado_desempeno_id', 'id')->orderBy('id');
        } else {
            return $this->hasMany(EvaluadoresEvaluacionCompetenciasDesempeno::class, 'evaluado_desempeno_id', 'id')->where('periodo_id', $id_periodo)->orderBy('id')->get();
        }
    }

    public function getNombresEvaluadoresAttribute()
    {
        $evaluado = self::find($this->id);
        $nombres = [];

        if ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos) {
            $evaluadoresCompetenciasIds = $this->evaluadoresCompetencias->pluck('evaluador_desempeno_id')->toArray();
            $evaluadoresObjetivosIds = $this->evaluadoresObjetivos->pluck('evaluador_desempeno_id')->toArray();

            // Calculate the distinct evaluador_desempeno_id that match in both relations
            $matchingIds = array_intersect($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds);

            // Calculate the evaluador_desempeno_id that don't match in both relations
            $distinctIds = array_merge(
                array_diff($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds),
                array_diff($evaluadoresObjetivosIds, $evaluadoresCompetenciasIds)
            );

            $nombres = array_unique(array_merge($matchingIds, $distinctIds));
        } elseif ($evaluado->evaluacion->activar_competencias && ! $evaluado->evaluacion->activar_objetivos) {
            $nombres = $this->evaluadoresCompetencias->pluck('evaluador_desempeno_id')->unique()->toArray();
        } elseif (! $evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos) {
            $nombres = $this->evaluadoresObjetivos->pluck('evaluador_desempeno_id')->unique()->toArray();
        }

        //Enviamos los ids, para que sea mas facil de manejar
        return $nombres;
    }

    public function getCuentaEvaluacionesAttribute()
    {
        $total = 0;

        $evaluado = self::find($this->id);

        if ($evaluado->evaluacion->activar_competencias && $this->evaluacion->activar_objetivos) {
            $evaluadoresCompetenciasIds = $this->evaluadoresCompetencias->pluck('evaluador_desempeno_id')->toArray();
            $evaluadoresObjetivosIds = $this->evaluadoresObjetivos->pluck('evaluador_desempeno_id')->toArray();

            // Calculate the distinct count of evaluador_desempeno_id that match in both relations
            $matchingCount = count(array_intersect($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds));

            // Calculate the count of evaluador_desempeno_id that don't match in both relations
            $distinctCount = count(array_diff($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds))
                + count(array_diff($evaluadoresObjetivosIds, $evaluadoresCompetenciasIds));

            $total = $matchingCount + $distinctCount;
        } elseif ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos == false) {
            $total = $evaluado->evaluadoresCompetencias->count();
        } elseif ($evaluado->evaluacion->activar_competencias == false && $evaluado->evaluacion->activar_objetivos) {
            $total = $evaluado->evaluadoresObjetivos->count();
        }

        return $total;
    }

    public function getCuentaEvaluacionesCompletadasAttribute()
    {
        $total = 0;

        $evaluado = self::find($this->id);

        if ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos) {
            $evaluadoresCompetenciasIds = $evaluado->evaluadoresCompetencias->where('finalizada', true)->pluck('evaluador_desempeno_id')->toArray();
            $evaluadoresObjetivosIds = $evaluado->evaluadoresObjetivos->where('finalizada', true)->pluck('evaluador_desempeno_id')->toArray();

            // Calculate the distinct count of evaluador_desempeno_id that match in both relations
            $matchingCount = count(array_intersect($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds));

            // Calculate the count of evaluador_desempeno_id that don't match in both relations
            $distinctCount = count(array_diff($evaluadoresCompetenciasIds, $evaluadoresObjetivosIds))
                + count(array_diff($evaluadoresObjetivosIds, $evaluadoresCompetenciasIds));

            $total = $matchingCount + $distinctCount;
        } elseif ($evaluado->evaluacion->activar_competencias && $evaluado->evaluacion->activar_objetivos == false) {
            $total = $evaluado->evaluadoresCompetencias->where('finalizada', true)->count();
        } elseif ($evaluado->evaluacion->activar_competencias == false && $evaluado->evaluacion->activar_objetivos) {
            $total = $evaluado->evaluadoresObjetivos->where('finalizada', true)->count();
        }

        return $total;
    }

    public function getCalificacionesObjetivosEvaluadoAttribute()
    {
        $evaluado = self::find($this->id);
        $evaluadores = $evaluado->evaluadoresObjetivos->where('evaluador_desempeno_id', '!=', $this->evaluado_desempeno_id);

        $calificacionesAgrupadas = [];

        foreach ($evaluadores as $evlrs) {
            foreach ($evlrs->preguntasCuestionarioAplican as $pregunta) {
                $valor_maximo = (float) $pregunta->infoObjetivo->valor_maximo_unidad_objetivo;
                $valor_minimo = (float) $pregunta->infoObjetivo->valor_minimo_unidad_objetivo;
                $calificacion_objetivo = (float) $pregunta->calificacion_objetivo;
                $porcentaje = (float) $evlrs->porcentaje_objetivos;

                // Lógica para manejar valores negativos y máximos en 0
                if ($valor_maximo > 0) {
                    // Caso normal: dividir por el valor máximo
                    $calificacion_total = ($calificacion_objetivo / $valor_maximo) * $porcentaje;
                } elseif ($valor_maximo == 0 && $valor_minimo < 0) {
                    // Caso especial: valor máximo es 0 y mínimo negativo (objetivo de 0 incidencias, rechazos, etc.)
                    if ($calificacion_objetivo === 0) {
                        $calificacion_total = $porcentaje; // Máxima calificación si logramos 0
                    } else {
                        $calificacion_total = (1 - (($calificacion_objetivo - $valor_minimo) / abs($valor_minimo))) * $porcentaje;
                    }
                } else {
                    // Si no hay datos válidos, asumimos calificación 0
                    $calificacion_total = 0;
                }

                $calificacion = [
                    'objetivo_id' => $pregunta->objetivo_id,
                    'tipo' => $pregunta->infoObjetivo->tipo_objetivo,
                    'calificacion_objetivo' => $calificacion_objetivo,
                    'calificacion_total' => round($calificacion_total, 2),
                ];

                // Agrupar por objetivo_id
                if (!isset($calificacionesAgrupadas[$pregunta->objetivo_id])) {
                    $calificacionesAgrupadas[$pregunta->objetivo_id] = [];
                }

                $calificacionesAgrupadas[$pregunta->objetivo_id][] = $calificacion;
            }
        }

        $calificacionesSumadas = [];
        foreach ($calificacionesAgrupadas as $objetivo_id => $calificaciones) {
            $suma = array_sum(array_column($calificaciones, 'calificacion_total'));
            $calificacionesSumadas[] = [
                'objetivo_id' => $objetivo_id,
                'tipo' => $calificaciones[0]['tipo'],
                'calificacion_total' => round($suma, 2),
            ];
        }

        $totalCalificaciones = count($calificacionesSumadas);
        $sumaTotal = array_sum(array_column($calificacionesSumadas, 'calificacion_total'));
        $promedio = $totalCalificaciones > 0 ? $sumaTotal / $totalCalificaciones : 0;

        return [
            'calif_agrup' => $calificacionesAgrupadas,
            'calif_total' => $calificacionesSumadas,
            'promedio_total' => round($promedio, 2),
        ];
    }

    public function getCalificacionesCompetenciasEvaluadoAttribute()
    {
        $evaluado = self::find($this->id);

        $evaluadores = $evaluado->evaluadoresCompetencias->where('evaluador_desempeno_id', '!=', $this->evaluado_desempeno_id);

        $calificacionesAgrupadas = [];

        foreach ($evaluadores as $evlrs) {
            foreach ($evlrs->preguntasCuestionario as $pregunta) {
                try {
                    $calificacion = [
                        'competencia_id' => $pregunta->competencia_id,
                        'competencia' => $pregunta->infoCompetencia->competencia,
                        'calificacion_competencia' => $pregunta->calificacion_competencia,
                        'calificacion_total' => round((($pregunta->calificacion_competencia / $pregunta->infoCompetencia->nivel_esperado) * $evlrs->porcentaje_competencias), 2),
                    ];

                    if (! isset($calificacionesAgrupadas[$pregunta->competencia_id])) {
                        $calificacionesAgrupadas[$pregunta->competencia_id] = [];
                    }

                    $calificacionesAgrupadas[$pregunta->competencia_id][] = $calificacion;
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($pregunta, $pregunta->calificacion_competencia, $pregunta->infoCompetencia->nivel_esperado, $evlrs->porcentaje_competencias);
                }
            }
        }

        $calificacionesSumadas = [];

        foreach ($calificacionesAgrupadas as $competencia_id => $calificaciones) {
            $suma = 0;

            foreach ($calificaciones as $calificacion) {
                $suma += $calificacion['calificacion_total'];
            }

            $calificacionesSumadas[] = [
                'competencia_id' => $competencia_id,
                'competencia' => $calificacion['competencia'],
                'calificacion_total' => $suma,
            ];
        }

        $totalCalificaciones = count($calificacionesSumadas);

        $sumaTotal = 0;
        foreach ($calificacionesSumadas as $calificacion) {
            $sumaTotal += $calificacion['calificacion_total'];
        }

        $promedio = $totalCalificaciones > 0 ? $sumaTotal / $totalCalificaciones : 0;
        $promedioRedondeado = round($promedio, 2);

        return [
            'calif_agrup' => $calificacionesAgrupadas,
            'calif_total' => $calificacionesSumadas,
            'promedio_total' => $promedioRedondeado,
        ];
    }

    public function calificacionesObjetivosEvaluadoPeriodo($periodo)
    {
        $evaluado = self::find($this->id);
        $evaluadores = $evaluado->evaluadoresObjetivos->where('evaluador_desempeno_id', '!=', $this->evaluado_desempeno_id);

        $calificacionesAgrupadas = [];

        foreach ($evaluadores as $evlrs) {
            $evrs = $evlrs->preguntasCuestionarioAplican->where('periodo_id', $periodo);
            foreach ($evrs as $pregunta) {
                $valor_maximo = (float) $pregunta->infoObjetivo->valor_maximo_unidad_objetivo;
                $valor_minimo = (float) $pregunta->infoObjetivo->valor_minimo_unidad_objetivo;
                $calificacion_objetivo = (float) $pregunta->calificacion_objetivo;
                $porcentaje = (float) $evlrs->porcentaje_objetivos;

                // Lógica para manejar valores negativos y máximos en 0
                if ($valor_maximo > 0) {
                    // Caso normal: dividir por el valor máximo
                    $calificacion_total = ($calificacion_objetivo / $valor_maximo) * $porcentaje;
                } elseif ($valor_maximo == 0 && $valor_minimo < 0) {
                    // Caso especial: valor máximo es 0 y mínimo negativo (objetivo de 0 incidencias, rechazos, etc.)
                    if ($calificacion_objetivo === 0) {
                        $calificacion_total = $porcentaje; // Máxima calificación si logramos 0
                    } else {
                        $calificacion_total = (1 - (($calificacion_objetivo - $valor_minimo) / abs($valor_minimo))) * $porcentaje;
                    }
                } else {
                    // Si no hay datos válidos, asumimos calificación 0
                    $calificacion_total = 0;
                }

                $calificacion = [
                    'objetivo_id' => $pregunta->objetivo_id,
                    'nombre' => $pregunta->infoObjetivo->objetivo,
                    'tipo' => $pregunta->infoObjetivo->tipo_objetivo,
                    'calificacion_objetivo' => $calificacion_objetivo,
                    'calificacion_total' => round($calificacion_total, 2),
                ];

                // Agrupar por objetivo_id
                if (!isset($calificacionesAgrupadas[$pregunta->objetivo_id])) {
                    $calificacionesAgrupadas[$pregunta->objetivo_id] = [];
                }

                $calificacionesAgrupadas[$pregunta->objetivo_id][] = $calificacion;
            }
        }

        $calificacionesSumadas = [];
        foreach ($calificacionesAgrupadas as $objetivo_id => $calificaciones) {
            $suma = array_sum(array_column($calificaciones, 'calificacion_total'));

            $calificacionesSumadas[] = [
                'objetivo_id' => $objetivo_id,
                'nombre' => $calificaciones[0]['nombre'],
                'tipo' => $calificaciones[0]['tipo'],
                'calificacion_total' => round($suma, 2),
            ];
        }

        $totalCalificaciones = count($calificacionesSumadas);
        $sumaTotal = array_sum(array_column($calificacionesSumadas, 'calificacion_total'));
        $promedio = $totalCalificaciones > 0 ? $sumaTotal / $totalCalificaciones : 0;

        return [
            'calif_agrup' => $calificacionesAgrupadas,
            'calif_total' => $calificacionesSumadas,
            'promedio_total' => round($promedio, 2),
        ];
    }


    public function calificacionesCompetenciasEvaluadoPeriodo($periodo)
    {
        $evaluado = self::find($this->id);

        $evaluadores = $evaluado->evaluadoresCompetencias->where('evaluador_desempeno_id', '!=', $this->evaluado_desempeno_id);
        $cuenta_evaluadores = $evaluadores->count();
        $calificacionesAgrupadas = [];

        foreach ($evaluadores as $evlrs) {
            $evrs = $evlrs->preguntasCuestionario->where('periodo_id', $periodo);
            foreach ($evrs as $pregunta) {
                $calificacion_total = ($pregunta->calificacion_competencia > $pregunta->infoCompetencia->nivel_esperado) ? $pregunta->infoCompetencia->nivel_esperado : $pregunta->calificacion_competencia;

                $calificacion = [
                    'competencia_id' => $pregunta->competencia_id,
                    'competencia' => $pregunta->infoCompetencia->competencia,
                    'calificacion_competencia' => $pregunta->calificacion_competencia,
                    'nivel_esperado' => $pregunta->infoCompetencia->nivel_esperado,
                    'calificacion_total' => round(($calificacion_total / $pregunta->infoCompetencia->nivel_esperado) * $evlrs->porcentaje_competencias, 2),
                ];

                if (! isset($calificacionesAgrupadas[$pregunta->competencia_id])) {
                    $calificacionesAgrupadas[$pregunta->competencia_id] = [];
                }

                $calificacionesAgrupadas[$pregunta->competencia_id][] = $calificacion;
            }
        }

        $calificacionesSumadas = [];

        foreach ($calificacionesAgrupadas as $competencia_id => $calificaciones) {
            $suma = 0;
            $suma_competencia = 0;

            foreach ($calificaciones as $calificacion) {
                $suma += $calificacion['calificacion_total'];
                $suma_competencia += $calificacion['calificacion_competencia'];
            }

            $promedio_competencia = ($suma_competencia / $cuenta_evaluadores);

            $calificacionesSumadas[] = [
                'competencia_id' => $competencia_id,
                'competencia' => $calificacion['competencia'],
                'nivel_esperado' => $calificacion['nivel_esperado'],
                'promedio_competencias' => $promedio_competencia,
                'calificacion_total' => $suma,
            ];
        }

        $totalCalificaciones = count($calificacionesSumadas);

        $sumaTotal = 0;
        foreach ($calificacionesSumadas as $calificacion) {
            $sumaTotal += $calificacion['calificacion_total'];
        }

        $promedio = $totalCalificaciones > 0 ? $sumaTotal / $totalCalificaciones : 0;
        $promedioRedondeado = round($promedio, 2);

        return [
            'calif_agrup' => $calificacionesAgrupadas,
            'calif_total' => $calificacionesSumadas,
            'promedio_total' => $promedioRedondeado,
        ];
    }

    public function calificacionesEscalasEvaluadoPeriodo($periodo)
    {
        $evaluado = self::find($this->id);

        // Filtrar evaluadores excluyendo al mismo evaluado
        $evaluadores = $evaluado->evaluadoresObjetivos->where('evaluador_desempeno_id', '!=', $this->evaluado_desempeno_id);

        // Agrupar calificaciones por objetivo_id
        $calificacionesAgrupadas = [];

        foreach ($evaluadores as $evlrs) {
            foreach ($evlrs->preguntasCuestionarioAplican->where('periodo_id', $periodo) as $pregunta) {
                $objetivoId = $pregunta->objetivo_id;
                $valorMaximo = $pregunta->infoObjetivo->valor_maximo_unidad_objetivo;
                $valorMinimo = $pregunta->infoObjetivo->valor_minimo_unidad_objetivo;
                $calificacionObjetivo = $pregunta->calificacion_objetivo;
                $estatusCalificado = $pregunta->estatus_calificado;

                // Manejo de calificación total evitando división por 0 y considerando valores negativos
                if ($valorMaximo == 0) {
                    $calificacionTotal = 0;
                } else {
                    $calificacionNormalizada = ($calificacionObjetivo - $valorMinimo) / ($valorMaximo - $valorMinimo);
                    $calificacionTotal = round(($calificacionNormalizada * $evlrs->porcentaje_objetivos), 2);
                }

                // Asegurar que el array esté inicializado
                if (!isset($calificacionesAgrupadas[$objetivoId])) {
                    $calificacionesAgrupadas[$objetivoId] = [
                        'objetivo_id' => $objetivoId,
                        'calificacion_total' => 0,
                        'estatus_calificado' => $estatusCalificado,
                    ];
                }

                // Sumar la calificación total
                $calificacionesAgrupadas[$objetivoId]['calificacion_total'] += $calificacionTotal;
            }
        }

        return ['calif_escala' => array_values($calificacionesAgrupadas)];
    }
}
