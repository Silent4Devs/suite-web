<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class CentroCosto extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'centro_costos';

    public $fillable = [
        'id',
        'clave',
        'descripcion',
        'estado',
        'archivo',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('CentroCosto:all', 3600 * 12, function () {
            return self::orderBy('id')->get();
        });
    }
}
