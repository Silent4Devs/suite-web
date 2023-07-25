<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoActivo extends Model
{
    use SoftDeletes;

    public $table = 'documento_activos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'activo_id',
        'documento',

    ];

    public function documentos_activos()
    {
        return $this->belongsTo(Activo::class, 'activo_id');
    }
}
