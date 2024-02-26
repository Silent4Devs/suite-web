<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Cache;
use App\Traits\ClearsResponseCache;

class CatalogoRangosObjetivos extends Model implements Auditable
{
    use HasFactory;
    use ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'catalogo_rangos_objetivos';

    protected $fillable = [
        'nombre_catalogo',
        'descripcion',
    ];

    public static function getAll()
    {
        return Cache::remember('CatalogosRangos:catalogos_rangos_all', 3600 * 12, function () {
            return self::with('rangos')->get();
        });
    }

    public function rangos()
    {
        return $this->hasMany(RangosObjetivos::class, 'catalogo_rangos_id', 'id');
    }
}
