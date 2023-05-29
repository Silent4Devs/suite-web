<?php

namespace App\Models\Iso27;

use Database\Seeders\GapUnoCatalogoIsoSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GapUnoConcentratoIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'valoracion',
        'evidencia',
        'recomendacion',
        'id_gap_uno_catalogo',
        'id_analisis_brechas'
    ];

    public function gap_uno_catalogo()
    {
        return $this->hasOne(GapUnoCatalogoIsoSeeder::class, 'id_gap_uno_catalogo', 'id');
    }

    public function analisis_brechas()
    {
        return $this->hasOne(AnalisisBrecha::class, 'id_analisis_brechas', 'id');
    }
}
