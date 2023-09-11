<?php

namespace App\Models\ContractManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
    use HasFactory;

    public $table = 'centro_costos';

    public $fillable = [
        'id',
        'clave',
        'descripcion',
        'estado',
        'archivo',
    ];
}
