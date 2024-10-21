<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Plantilla extends Model implements Auditable
{
    use AuditableTrait, ClearsResponseCache;
    use HasFactory;

    public $table = 'plantillas';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'nom_plantilla',
        'contenido',
        'variables_utilizadas',
    ];
}
