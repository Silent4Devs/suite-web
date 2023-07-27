<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TiposObjetivosSistema extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_objetivo_sistema';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function objetivosseguridad()
    {
        return $this->hasMany(Objetivosseguridad::class, 'tipo_objetivo_sistema_id');
    }
}
