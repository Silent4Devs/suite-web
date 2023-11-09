<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Sucursal extends Model  implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'clave',
        'descripcion',
        'rfc',
        'empresa',
        'cuenta_contable',
        'estado',
        'zona',
        'archivo',
        'direccion',
        'mylogo',
    ];

    public $table = 'sucursales';
}
