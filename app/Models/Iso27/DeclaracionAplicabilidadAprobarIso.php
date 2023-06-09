<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Empleado;
use Carbon\Carbon;

class DeclaracionAplicabilidadAprobarIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'estatus',
        'comentarios',
        'fecha_aprobacion',
        'empleado_id',
        'declaracion_id',
    ];

    public function gapdos()
    {
        return $this->hasOne(GapDosCatalogoIso::class, 'id', 'declaracion_id');
    }

    public function aprobador_declaracion()
    {
        return $this->hasMany(Empleado::class, 'id', 'empleado_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }

    public function declaracion()
    {
        return $this->hasOne(DeclaracionAplicabilidadConcentradoIso::class, 'declaracion_id', 'id');
    }
}
