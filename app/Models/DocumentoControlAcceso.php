<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoControlAcceso extends Model
{
    use SoftDeletes;
    protected $table = 'documento_control_accesos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $cast = [
        'controlA_id',
        'documento',
    ];

    protected $fillable = [
        'controlA_id',
        'documento',

    ];

    public function documentos_controlA()
    {
        return $this->belongsTo(ControlAcceso::class, 'controlA_id');
    }
}
