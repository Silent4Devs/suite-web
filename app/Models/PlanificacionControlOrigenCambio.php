<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlanificacionControlOrigenCambio extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'planificacion_control_origen_cambio';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function origen()
    {
        return $this->hasMany(self::class, 'origen_id');
    }
}
