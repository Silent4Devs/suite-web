<?php

namespace App\Models\Iso27;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class GapUnoConcentratoIso extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'valoracion',
        'evidencia',
        'recomendacion',
        'id_gap_uno_catalogo',
        'id_analisis_brechas',
    ];

    public function gap_uno_catalogo()
    {
        return $this->hasOne(GapUnoCatalogoIso::class, 'id', 'id_gap_uno_catalogo');
    }

    public function analisis_brechas()
    {
        return $this->hasOne(AnalisisBrechaIso::class, 'id_analisis_brechas', 'id');
    }
}
