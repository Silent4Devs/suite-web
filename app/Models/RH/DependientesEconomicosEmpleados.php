<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DependientesEconomicosEmpleados extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'dependientes_economicos_empleados';

    protected $fillable = ['empleado_id', 'nombre', 'parentesco'];
}
