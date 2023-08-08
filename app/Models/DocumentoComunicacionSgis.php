<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DocumentoComunicacionSgis extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
