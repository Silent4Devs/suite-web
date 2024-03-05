<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class VersionesIso extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'versiones_iso';

    protected $casts = [
        'version_historico' => 'boolean',
    ];

    protected $fillable = [
        'version_historico',
    ];

    public static function getFirst()
    {
        $cacheKey = 'VersionesIso:First';

        return Cache::remember($cacheKey, now()->addHours(12), function () {
            return DB::table('versiones_iso')->select('id', 'version_historico')->first();
        });
    }
}
