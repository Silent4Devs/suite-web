<?php

namespace App\Models\Iso27;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GapDosConcentradoIso extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'id',
        'id_gap_dos_catalogo',
        'id_analisis_brechas',
        'valoracion',
        'evidencia',
        'recomendacion',
    ];

    public function gap_dos_catalogo()
    {
        return $this->hasOne(GapDosCatalogoIso::class, 'id', 'id_gap_dos_catalogo');
    }

    public function analisis_brechas()
    {
        return $this->hasOne(AnalisisBrechasIso::class, 'id_analisis_brechas', 'id');
    }
}
