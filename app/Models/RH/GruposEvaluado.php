<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class GruposEvaluado extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ev360_grupos_evaluados';

    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_empleados_grupos_evaluados', 'grupo_id', 'empleado_id');
    }
}
