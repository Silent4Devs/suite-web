<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ConfigurarSoporteModel extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;
    public $table = 'configuracion_soporte';

    protected $fillable = [
        'rol',
        'puesto',
        'telefono',
        'extension',
        'tel_celular',
        'correo',
        'id_elaboro',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elaboro')->alta();
    }
}
