<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'productos';

    public $fillable = [
        'id',
        'descripcion',
        'archivo',
        'clave',
    ];

    public static function getAll()
    {
        return Cache::remember('Producto:Producto_all', 3600 * 6, function () {
            return self::get();
        });
    }
}
