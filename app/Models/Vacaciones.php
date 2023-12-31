<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Vacaciones extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'vacaciones';

    public $fillable = [
        'nombre',
        'descripcion',
        'dias',
        'afectados',
        'tipo_conteo',
        'inicio_conteo',
        'fin_conteo',
        'incremento_dias',
        'periodo_corte',
    ];

    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'dias' => 'integer',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'regla_vacaciones_areas', 'regla_id', 'area_id');
    }
}
