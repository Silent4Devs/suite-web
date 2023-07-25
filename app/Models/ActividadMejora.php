<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActividadMejora extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'actividades_mejoras';

    protected $guarded = ['id'];

    public function mejora()
    {
        return $this->belongsTo(Mejoras::class, 'mejora_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsToMany(Empleado::class, 'actividades_mejoras_responsables', 'actividad_id', 'responsable_id')->alta();
    }
}
