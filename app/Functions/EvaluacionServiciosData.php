<?php

namespace App\Functions;

use App\Models\Katbol\EvaluacionServicio;
use App\Models\Katbol\NivelesServicio;
use Carbon\Carbon;

class EvaluacionServiciosData
{
    public function conteoFechas($id_evaluacion, $periodo_evaluacion, $revisiones)
    {
        $actual = Carbon::now();
        $date = Carbon::now();
        switch ($periodo_evaluacion) {
            case 0:
                return [];
                break;
            case 1:
                $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Unica vez', 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];

                return $data;
                break;
            case 2:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Dia', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 3:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Semana', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 4:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Quincena', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 5:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Mes', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 6:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Bimestre', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 7:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Trimestre', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 8:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Semestre', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 9:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Año', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
            case 10:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'evaluacion' => 'Mes', 'evaluacion_day' => $i, 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                }

                return $data;
                break;
        }
    }

    public function TraerDatos($id_evaluacion, $periodo_evaluacion, $revisiones, $nombre, $metrica, $unidad)
    {
        $actual = Carbon::now();
        $date = Carbon::now();
        switch ($periodo_evaluacion) {
            case 0:
                return [];
                break;
            case 1:
                $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];

                return $data;
                break;
            case 2:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addWeekday();
                }

                return $data;
                break;
            case 3:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addWeek();
                }

                return $data;
                break;
            case 4:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addWeeks(2);
                }

                return $data;
                break;
            case 5:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addMonth();
                }

                return $data;
                break;
            case 6:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addMonths(2);
                }

                return $data;
                break;
            case 7:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addMonths(3);
                }

                return $data;
                break;
            case 8:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addMonths(6);
                }

                return $data;
                break;
            case 9:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addYears(1);
                }

                return $data;
                break;
            case 10:
                $data = [];
                for ($i = 1; $i <= $revisiones; $i++) {
                    $data[] = ['servicio_id' => $id_evaluacion, 'nombre' => $nombre, 'metrica' => $metrica, 'unidad' => $unidad, 'fecha' => $date->toDateString(), 'created_at' => $actual, 'created_by' => auth()->user()->empleado->id, 'updated_by' => auth()->user()->empleado->id];
                    $date->addYears(2);
                }

                return $data;
                break;
        }
    }

    public function ActualizarDatos($id_evaluacion, $periodo_evaluacion, $revisiones, $nombre, $metrica, $unidad)
    {
        $evaluaciones = EvaluacionServicio::where('servicio_id', '=', $id_evaluacion)->get();
        $servicio = NivelesServicio::select('periodo_evaluacion')->where('id', '=', $id_evaluacion)->first();
        $nombre_servicio = $nombre != null ? $nombre : $evaluaciones->nombre;
        $metrica_servicio = $metrica != null ? $metrica : $evaluaciones->metrica;
        $unidad_servicio = $unidad != null ? $unidad : $evaluaciones->unidad;
        $numero_actual_evaluaciones = count($evaluaciones);
        foreach ($evaluaciones as $evaluacion) {
            $evaluacion->update([
                'nombre' => $nombre_servicio,
                'metrica' => $metrica_servicio,
                'unidad' => $unidad_servicio,
            ]);
        }
        if ($servicio->periodo_evaluacion != $periodo_evaluacion) {
            //$this->actualizarPeriodo($evaluaciones, $numero_actual_evaluaciones, $periodo_evaluacion);
        }

        $agregar_mas_evaluaciones = $revisiones > $numero_actual_evaluaciones ? true : false;
        if ($agregar_mas_evaluaciones) {
            $revisiones_faltantes = $revisiones - $numero_actual_evaluaciones;
            $this->TraerDatos($id_evaluacion, $periodo_evaluacion, $revisiones_faltantes, $nombre, $metrica, $unidad);
        }
    }

    public function actualizarPeriodo($evaluaciones, $numero_actual_evaluaciones, $periodo_evaluacion, $fecha_iniciacion)
    {
        $date = $fecha_iniciacion;
        switch ($periodo_evaluacion) {
            case 1:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->destroy();
                }
                break;
            case 2:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addWeekday();
                }
                break;
            case 3:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addWeek();
                }
                break;
            case 4:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addWeeks(2);
                }
                break;
            case 5:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addMonth();
                }
                break;
            case 6:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addMonths(2);
                }
                break;
            case 7:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addMonths(3);
                }
                break;
            case 8:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addMonths(6);
                }
                break;
            case 9:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addYears(1);
                }
                break;
            case 10:
                for ($i = 1; $i < $numero_actual_evaluaciones; $i++) {
                    $evaluaciones[$i]->update([
                        'fecha' => $date->toDateString(),
                    ]);
                    $date->addYears(2);
                }
                break;
        }
    }
}
