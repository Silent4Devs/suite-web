<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclaracionAplicabilidadConcentradoIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'valoracion',
        'id_gap_dos_catalogo'
    ];

    public function gapdos()
    {
        return $this->hasOne(GapDosCatalogoIso::class, 'id_gap_dos_catalogo', 'id');
    }
}
