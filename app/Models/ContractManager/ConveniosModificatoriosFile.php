<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class ConveniosModificatoriosFile extends Model implements Auditable
{
    use AuditableTrait;
    use ClearsResponseCache, HasFactory, softDeletes;

    public $table = 'convenios_modificatorios_files';

    protected $fillable = [
        'convenios_file',
        'convenios_modificatorios_id',
        'created_by',
        'updated_by',
    ];
}
