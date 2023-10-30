<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TiposObjetivosSistema extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'tipo_objetivo_sistema';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function objetivosseguridad()
    {
        return $this->hasMany(Objetivosseguridad::class, 'tipo_objetivo_sistema_id');
    }
}
