<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanificacionControlOrigenCambio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='planificacion_control_origen_cambio';

    protected $fillable=[
        'nombre',
        'descripcion',
    ];

    public function origen()
    {
        return $this->hasMany(PlanificacionControlOrigenCambio::class, 'origen_id');

    }

}
