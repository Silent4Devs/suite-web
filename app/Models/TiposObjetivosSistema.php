<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposObjetivosSistema extends Model
{
    use HasFactory;

    protected $table = 'tipo_objetivo_sistema';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function objetivosseguridad()
    {
        return $this->hasMany(Objetivosseguridad::class, 'tipo_objetivo_sistema_id');
    }
}
