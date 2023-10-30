<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VariablePlantilla extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use AuditableTrait;

    public $table = 'variables_plantillas';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
    ];
}
