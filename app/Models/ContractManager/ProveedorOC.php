<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class ProveedorOC extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
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

    public static function getAll()
    {
        return Cache::remember('ProveedorOC:Proveedor_all', 3600 * 6, function () {
            return self::get();
        });
    }
}
