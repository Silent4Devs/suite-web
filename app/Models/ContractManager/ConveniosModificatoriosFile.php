<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConveniosModificatoriosFile extends Model implements Auditable
{
    use HasFactory, softDeletes, ClearsResponseCache;
    use AuditableTrait;

    public $table = 'convenios_modificatorios_files';

    protected $fillable = [
        'convenios_file',
        'convenios_modificatorios_id',
        'created_by',
        'updated_by',
    ];
}
