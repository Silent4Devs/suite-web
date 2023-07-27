<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DayOff extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'day_off';

    public $fillable = [
        'nombre',
        'descripcion',
        'dias',
        'afectados',
        'tipo_conteo',
        'inicio_conteo',
        'incremento_dias',
        'periodo_corte',
        'meses',
    ];

    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'dias' => 'integer',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'regla_dayOff_areas', 'regla_id', 'area_id');
    }
}
