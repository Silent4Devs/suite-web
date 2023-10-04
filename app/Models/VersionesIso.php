<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Cache;

class VersionesIso extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
            return self::first();
        });
    }

}
