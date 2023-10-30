<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProveedorRequisicion extends Model
{
    use HasFactory, ClearsResponseCache;

    protected $fillable = [
    'proveedor',
    'detalles',
    'tipo',
    'comentarios',
    'contacto',
    'contacto_correo',
    'url',
    'cel',
    'fecha_inicio',
    'fecha_fin',
    'cotizacion',
    'requisiciones_id',
    ];

    public $table = 'proveedor_requisicions';
}
