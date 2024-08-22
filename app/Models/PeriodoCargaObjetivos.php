<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoCargaObjetivos extends Model
{
    use HasFactory;

    protected $table = 'periodo_carga_objetivos';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'habilitado',
    ];
}
