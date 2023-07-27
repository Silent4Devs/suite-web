<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoConcientizacionSgis extends Model
{
    use SoftDeletes;

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
