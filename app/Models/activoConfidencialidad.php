<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class activoConfidencialidad extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'activo_confidencialidad';

    protected $guarded = [
        'id',
        'confidencialidad',
        'valor',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('ActivosConfidencial_all', 3600 * 12, function () {
            return self::get();
        });
    }
}
