<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class ObjetivoEmpleado extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_objetivo_empleados';

    protected $fillable = [
        'empleado_id',
        'objetivo_id',
        'completado',
        'en_curso',
        'papelera',
        'ev360',
        'mensual',
        'bimestral',
        'trimestral',
        'semestral',
        'anualmente',
        'abierta',
    ];

    public static function getAllwithObjetivo()
    {
        return Cache::remember('ObjetivoEmpleado:get_all_with_objetivo', 3600 * 8, function () {
            return self::with(['objetivo' => function ($query) {
                $query->with(['tipo', 'metrica']);
            }])->get();
        });
    }

    public function objetivo()
    {
        return $this->belongsTo('App\Models\RH\Objetivo', 'objetivo_id', 'id');
    }
}
