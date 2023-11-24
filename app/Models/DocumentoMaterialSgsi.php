<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DocumentoMaterialSgsi extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'documentos_material_sgsi';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $cast = [
        'material_id',
        'documento',
    ];

    protected $fillable = [
        'material_id',
        'documento',

    ];

    public function documentos_material()
    {
        return $this->belongsTo(MaterialSgsi::class, 'material_id');
    }
}
