<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoricoCedulaCumplimiento extends Model implements Auditable
{
    use AuditableTrait, ClearsResponseCache;
    use HasFactory;

    protected $table = 'cedula_cumplimiento_historico';
}
