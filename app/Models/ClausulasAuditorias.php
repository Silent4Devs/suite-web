<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClausulasAuditorias extends Model
{
    use HasFactory;

    protected $table = 'clausulas_auditorias';

    protected $fillable = [
        'identificador',
        'nombre_clausulas',
        'descripcion',
    ];
}
