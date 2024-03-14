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
    ];

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
}
