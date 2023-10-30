<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProveedorOC extends Model
{
    use HasFactory, ClearsResponseCache;

    protected $fillable = [
        'id',
        'nombre',
        'razon_social',
        'rfc',
        'contacto',
        'estado',
        'facturacion',
        'direccion',
        'envio',
        'credito',
        'fecha_inicio',
        'fecha_fin',
        ];

    public $table = 'proveedor_o_c_s';
}
