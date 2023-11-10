<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BeneficiariosEmpleado extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
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
