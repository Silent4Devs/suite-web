<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoCompetencia extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
