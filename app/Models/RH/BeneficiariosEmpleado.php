<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiariosEmpleado extends Model
{
    use HasFactory;

    protected $table = 'beneficiarios_empleados';

    protected $fillable = [
        'empleado_id',
        'nombre',
        'edad',
        'parentesco',
        'porcentaje',
    ];
}
