<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalasObjetivosDesempeno extends Model
{
    use HasFactory;

    protected $table = 'escalas_objetivos_desempenos';

    protected $fillable = [
        'id_objetivo_desempeno',
        'condicion',
        'valor',
        'parametro_id',
    ];
}
