<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ActividadQueja extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'actividades_quejas';

    protected $guarded = ['id'];

    public function queja()
    {
        return $this->belongsTo(Quejas::class, 'queja_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsToMany(Empleado::class, 'actividades_quejas_responsables', 'actividad_id', 'responsable_id')->alta();
    }
}
