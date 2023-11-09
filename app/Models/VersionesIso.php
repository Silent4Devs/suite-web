<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VersionesIso extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

        return Cache::remember($cacheKey, now()->addHours(24), function () {
            return self::select('id')->first();
        });
    }
}
