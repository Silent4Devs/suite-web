<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Moneda extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'monedas';

    protected $fillable = ['nombre'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Moneda:all', 3600 * 12, function () {
            return self::orderBy('id')->get();
        });
    }
}
