<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProveedorRequisicion extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

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
