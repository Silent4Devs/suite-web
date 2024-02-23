<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProveedorIndistinto extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'proveedor_indistintos';

    public $fillable = [
        'requisicion_id',
        'proveedor_indistinto_id',
        'fecha_inicio',
        'fecha_fin',
    ];

    //Redis methods
    public static function getFirst()
    {
        return Cache::remember('Katbol:proveedorIndistinto_first', 3600 * 7, function () {
            return self::first();
        });
    }
}
