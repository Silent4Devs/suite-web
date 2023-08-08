<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AjustesAIA extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'ajustes_aia';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'impacto_operativo',
        'impacto_regulatorio',
        'impacto_reputacion',
        'impacto_social',
    ];
}
