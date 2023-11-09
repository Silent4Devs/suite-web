<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeneficiariosEmpleado extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'beneficiarios_empleados';

    protected $fillable = [
        'empleado_id',
        'nombre',
        'edad',
        'parentesco',
        'porcentaje',
    ];
}
