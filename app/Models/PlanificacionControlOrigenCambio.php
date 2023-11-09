<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanificacionControlOrigenCambio extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
