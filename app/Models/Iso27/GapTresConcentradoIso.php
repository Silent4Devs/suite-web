<?php

namespace App\Models\Iso27;

use App\Models\AnalisisBrecha;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GapTresConcentradoIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'id_gap_tres_catalogo',
        'id_analisis_brechas',
        'valoracion',
        'evidencia',
        'recomendacion'
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
