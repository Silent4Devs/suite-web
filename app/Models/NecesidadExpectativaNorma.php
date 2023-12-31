<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NecesidadExpectativaNorma extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'normas_nececidades_expectativas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_norma',
        'id_necesidad_expectativa',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
