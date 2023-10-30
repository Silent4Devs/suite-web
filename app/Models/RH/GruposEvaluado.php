<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GruposEvaluado extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_grupos_evaluados';

    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_empleados_grupos_evaluados', 'grupo_id', 'empleado_id');
    }
}
