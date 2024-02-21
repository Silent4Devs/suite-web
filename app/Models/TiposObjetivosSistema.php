<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TiposObjetivosSistema extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'tipo_objetivo_sistema';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function objetivosseguridad()
    {
        return $this->hasMany(Objetivosseguridad::class, 'tipo_objetivo_sistema_id');
    }
}
