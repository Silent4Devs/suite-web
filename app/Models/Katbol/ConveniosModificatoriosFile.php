<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class ConveniosModificatoriosFile extends Model implements Auditable
{
    use HasFactory,softDeletes;
    use AuditableTrait;

    public $table = 'convenios_modificatorios_files';

    protected $fillable = [
        'convenios_file',
        'convenios_modificatorios_id',
        'created_by',
        'updated_by',
    ];
}
