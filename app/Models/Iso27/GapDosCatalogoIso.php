<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GapDosCatalogoIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'gap_dos_catalogo_isos';

    protected $fillable = [
        'id',
        'id_clasificacion',
        'control_iso',
        'anexo_politica',
        'anexo_descripcion',
    ];

    public function clasificacion()
    {
        return $this->hasOne(ClasificacionIso::class, 'id', 'id_clasificacion');
    }
}
