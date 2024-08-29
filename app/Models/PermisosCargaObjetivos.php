<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisosCargaObjetivos extends Model
{
    use HasFactory;

    protected $table = 'permisos_carga_objetivos';

    protected $fillable =
        [
            'perfil',
            'permisos_asignacion',
            'permiso_objetivos',
            'permiso_escala',
        ];
}
