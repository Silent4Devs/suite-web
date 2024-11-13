<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class TipoSolicitud extends Model implements Auditable
{
    use AuditableTrait;
    use ClearsResponseCache, HasFactory, SoftDeletes;

    public $table = 'tipo_solicitud';

    protected $fillable = [
        'nombre',
    ];
}
