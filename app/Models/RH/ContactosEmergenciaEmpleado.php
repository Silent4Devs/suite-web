<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ContactosEmergenciaEmpleado extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'contactos_emergencia_empleados';

    protected $fillable = [
        'empleado_id',
        'nombre',
        'telefono',
        'parentesco',
    ];
}
