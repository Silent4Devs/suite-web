<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoMaterialSgsi extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
