<?php

namespace App\Models\Iso27;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GapDosCatalogoIso extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

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
