<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class EvaluacionDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_desempenos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'activar_objetivos',
        'porcentaje_objetivos',
        'activar_competencias',
        'porcentaje_competencias',
        'tipo_periodo',
        'estatus',
        'autor_id',
    ];

    protected $appends =
        [
            'areas_evaluacion',
            'estatus_palabra',
            'total_evaluaciones',
            'total_evaluaciones_completadas',
            'porcentaje_evaluaciones_completadas',
            'cuenta_evaluados_evaluaciones_totales',
            'cuenta_evaluados_evaluaciones_completadas_totales',
        ];

    const BORRADOR = 0;

    const ACTIVO = 1;

    const CERRADO = 2;

    const PAUSADO = 3;

    public static function getAll()
    {
        return Cache::remember('EvaluacionesDesempeno:evaluaciones_desempeno_all', 3600 * 8, function () {
            return self::get();
        });
    }

    public function periodos()
    {
        return $this->hasMany(PeriodosEvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id')->orderBy('id');
    }

    public function escalas()
    {
        return $this->hasMany(EscalasEvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }

    public function evaluados()
    {
        return $this->hasMany(EvaluadosEvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }

    public function autor()
    {
        return $this->belongsTo(Empleado::class, 'autor_id', 'id');
    }

    public function getTotalEvaluacionesAttribute()
    {
        $evaluacion = self::find($this->id);

        $periodos = $evaluacion->periodos->count();

        return $periodos;
    }

    public function getTotalEvaluacionesCompletadasAttribute()
    {
        $evaluacion = self::find($this->id);

        $periodos = $evaluacion->periodos->where('finalizado', true)->count();

        return $periodos;
    }

    public function getAreasEvaluacionAttribute()
    {
        $evaluacion = self::find($this->id);

        $ids_areas = [];

        foreach ($evaluacion->evaluados as $evaluado) {
            $ids_areas[] = $evaluado->empleado->area_id;
        }

        $unique_ids = array_unique($ids_areas);

        return $unique_ids;
    }

    public function getPorcentajeEvaluacionesCompletadasAttribute()
    {
        $evaluacion = self::find($this->id);

        $porcentaje = 0;

        $periodos = $evaluacion->periodos->count();

        if ($periodos > 0) {
            $periodos_completados = $evaluacion->periodos->where('finalizado', true)->count();
            $porcentaje = ($periodos_completados / $periodos) * 100;
        }

        return $porcentaje;
    }

    public function getEstatusPalabraAttribute()
    {
        switch ($this->estatus) {
            case strval($this::BORRADOR):
                return 'Borrador';
                break;
            case strval($this::ACTIVO):
                return 'En curso';
                break;
            case strval($this::CERRADO):
                return 'Cerrada';
                break;
            case strval($this::PAUSADO):
                return 'Pausada';
                break;
            default:
                return '=';
                break;
        }
    }

    public function getCuentaEvaluadosEvaluacionesTotalesAttribute()
    {
        $evaluacion = self::find($this->id);

        return $evaluacion->evaluados->sum('cuenta_evaluaciones');
    }

    public function getCuentaEvaluadosEvaluacionesCompletadasTotalesAttribute()
    {
        $evaluacion = self::find($this->id);

        return $evaluacion->evaluados->sum('cuenta_evaluaciones_completadas');
    }
}
