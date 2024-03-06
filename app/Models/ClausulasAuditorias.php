<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ClausulasAuditorias extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'clausulas_auditorias';

    protected $fillable = [
        'identificador',
        'nombre_clausulas',
        'descripcion',
    ];
}
