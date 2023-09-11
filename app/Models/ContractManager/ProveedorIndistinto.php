<?php

namespace App\Models\ContractManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorIndistinto extends Model
{
    use HasFactory;

    public $table = 'proveedor_indistintos';

    public $fillable = [
        'requisicion_id',
        'proveedor_indistinto_id',
        'fecha_inicio',
        'fecha_fin',
    ];
}
