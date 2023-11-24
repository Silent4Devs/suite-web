<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AuditoriaAnualDocumento extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'documento_auditoria_anuals';

    protected $fillable = [
        'documento',
        'id_auditoria_anuals',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function auditoria_anual()
    {
        return $this->belongsTo(AuditoriaAnual::class, 'id_auditoria_anuals');
    }
}
