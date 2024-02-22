<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangosObjetivos extends Model
{
    use HasFactory;

    protected $table = 'rangos_objetivos';

    protected $fillable = [
        'catalogo_rangos_id',
        'parametro',
        'valor',
        'color',
        'descripcion',
    ];
}
