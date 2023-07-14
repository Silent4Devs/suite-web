<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class activoConfidencialidad extends Model
{
    use HasFactory;
    protected $table = 'activo_confidencialidad';

    protected $guarded = [
        'id',
        'confidencialidad',
        'valor',
    ];

    #Redis methods
    public static function getAll()
    {
        return Cache::remember('ActivosConfidencial_all', 3600 * 24, function () {
            return self::get();
        });
    }

}
