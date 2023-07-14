<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class TipoCompetencia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ev360_tipo_competencias';
    protected $guarded = ['id'];

    #Redis methods
    public static function getAll()
    {
        return Cache::remember('Tipocompetencias_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
