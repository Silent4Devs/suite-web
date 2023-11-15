<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IncidentesDayoff extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'incidentes_dayoff';

    public $fillable = [
        'nombre',
        'dias_aplicados',
        'aniversario',
        'efecto',
        'descripcion',
    ];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'incidentes_dayoff_empleados', 'incidente_id', 'empleado_id');
    }
}
