<?php

namespace App\Models\RH;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoContratoEmpleado extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $fillable = ['name', 'slug', 'description'];

    protected function empleados()
    {
        return $this->hasMany(Empleado::class, 'tipo_contrato_empleado_id', 'id')->alta();
    }
}
