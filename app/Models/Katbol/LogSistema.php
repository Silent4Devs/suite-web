<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class LogSistema extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'tablalogs';
}
