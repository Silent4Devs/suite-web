<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDePermiso extends Model
{
    use HasFactory;

    protected $table = 'tipo_permiso';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function controlacceso()
    {
        return $this->hasMany(ControlAcceso::class, 'tipo_control_acceso_id');
    }
}
