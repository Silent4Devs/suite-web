<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CentroCosto extends Model
{
    use HasFactory, ClearsResponseCache;

    public $table = 'centro_costos';

    public $fillable = [
        'id',
        'clave',
        'descripcion',
        'estado',
        'archivo',
    ];
}
