<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActividadSugerencia extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'actividades_sugerencias';

    protected $guarded = ['id'];

    public function sugerencia()
    {
        return $this->belongsTo(Sugerencias::class, 'sugerencia_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsToMany(Empleado::class, 'actividades_sugerencias_responsables', 'actividad_id', 'responsable_id')->alta();
    }
}
