<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TipoDePermiso extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'tipo_permiso';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function controlacceso()
    {
        return $this->hasMany(ControlAcceso::class, 'tipo_control_acceso_id');
    }
}
