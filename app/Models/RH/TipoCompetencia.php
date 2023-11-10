<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TipoCompetencia extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'ev360_tipo_competencias';

    protected $guarded = ['id'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Tipocompetencias_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
