<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoControlAcceso extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
