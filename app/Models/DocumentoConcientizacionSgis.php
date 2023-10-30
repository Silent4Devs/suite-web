<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoConcientizacionSgis extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;
    protected $table = 'documento_concientizacion_sgis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $cast = [
        'concientSgsi_id',
        'documento',
    ];

    protected $fillable = [
        'concientSgsi_id',
        'documento',

    ];

    public function documentos_concientizacion()
    {
        return $this->belongsTo(ConcientizacionSgi::class, 'concientSgsi_id');
    }
}
