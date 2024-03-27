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
        'estatus_palabra',
        'total_evaluaciones'
    ];

    const BORRADOR = 1;
    const ACTIVO = 2;
    const CERRADO = 3;
    const PAUSADO = 4;

    public static function getAll()
    {
        return Cache::remember('EvaluacionesDesempeno:evaluaciones_desempeno_all', 3600 * 8, function () {
            return self::get();
        });
    }

    public function periodos()
    {
        return $this->hasMany(PeriodosEvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
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
        $evaluacion = EvaluacionDesempeno::find($this->id);

        $periodos = $evaluacion->periodos->count();

        dd($periodos);
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
}
