<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactosEmergenciaEmpleado extends Model
{
    use HasFactory;

    protected $table = 'contactos_emergencia_empleados';

    protected $fillable = [
        'empleado_id',
        'nombre',
        'telefono',
        'parentesco',
    ];
}
