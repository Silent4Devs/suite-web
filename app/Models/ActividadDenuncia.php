<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ActividadDenuncia extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'actividades_denuncias';

    protected $guarded = ['id'];

    public function denuncia()
    {
        return $this->belongsTo(Denuncias::class, 'denuncia_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsToMany(Empleado::class, 'actividades_denuncias_responsables', 'actividad_id', 'responsable_id')->alta();
    }
}
