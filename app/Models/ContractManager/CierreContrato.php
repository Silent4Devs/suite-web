<?php

namespace App\Models\ContractManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class CierreContrato extends Model implements Auditable
{
    public $table = 'cierre_contratos';

    use HasFactory,softDeletes;
    use AuditableTrait;

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'contrato_id',
        'aspectos',
        'cumple',
        'observaciones',
        'created_by',
        'updated_by',
    ];
}
