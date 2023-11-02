<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoSolicitud extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use AuditableTrait;

    public $table = 'tipo_solicitud';

    protected $fillable = [
        'nombre',
    ];
}
