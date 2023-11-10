<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DocumentoComunicacionSgis extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    public $table = 'documentos_comunicacion_sgis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comunicacion_id',
        'documento',

    ];

    public function documentos_comunicacion()
    {
        return $this->belongsTo(ComunicacionSgi::class, 'comunicacion_id');
    }
}
