<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class activoConfidencialidad extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'activo_confidencialidad';

    protected $guarded = [
        'id',
        'confidencialidad',
        'valor',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('ActivosConfidencial_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
