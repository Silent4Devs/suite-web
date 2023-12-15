<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Sucursal extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
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
