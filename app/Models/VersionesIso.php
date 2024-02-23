<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
