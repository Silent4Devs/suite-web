<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentesVacaciones extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'incidentes_vacaciones';

    public $fillable = [
        'nombre',
        'dias_aplicados',
        'aniversario',
        'efecto',
        'descripcion',
    ];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'incidentes_vacaciones_empleados', 'incidente_id', 'empleado_id');
    }
}
