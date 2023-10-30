<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogSistema extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait, ClearsResponseCache;

    protected $table = 'tablalogs';
}
