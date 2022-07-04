<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacaciones extends Model
{
    use SoftDeletes;

    public $table = 'vacaciones';

    public $fillable = [
        'nombre',
        'descripcion',
        'dias',
        'afectados',
        'tipo_conteo',
        'inicio_conteo',
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
