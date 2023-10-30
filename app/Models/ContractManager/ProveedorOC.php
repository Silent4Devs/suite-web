<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class ProveedorOC extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;


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
