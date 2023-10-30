<?php

namespace App\Models\Iso27;

use App\Models\AnalisisBrecha;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GapTresConcentradoIso extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'id_gap_tres_catalogo',
        'id_analisis_brechas',
        'valoracion',
        'evidencia',
        'recomendacion',
    ];

    public function gap_tres_catalogo()
    {
        return $this->belongsTo(GapTresCatalogoIso::class, 'id_gap_tres_catalogo', 'id');
    }

    public function analisis_brechas()
    {
        return $this->hasOne(AnalisisBrecha::class, 'id_analisis_brechas', 'id');
    }
}
