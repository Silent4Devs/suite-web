<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class ClasificacionesAuditorias extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'clasificaciones_auditorias';

    protected $fillable = [
        'identificador',
        'nombre_clasificaciones',
        'descripcion',
    ];
}
