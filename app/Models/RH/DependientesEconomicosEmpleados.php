<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependientesEconomicosEmpleados extends Model
{
    use HasFactory;

    protected $table = 'dependientes_economicos_empleados';

    protected $fillable = ['empleado_id', 'nombre', 'parentesco'];
}
