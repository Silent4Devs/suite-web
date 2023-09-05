<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IncidentesVacaciones extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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
