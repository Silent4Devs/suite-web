<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoDePermiso extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'tipo_permiso';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function controlacceso()
    {
        return $this->hasMany(ControlAcceso::class, 'tipo_control_acceso_id');
    }
}
