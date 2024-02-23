<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ParametrosTemplateAnalisisdeBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'parametros_template_analisisde_brechas';

    public $fillable = [
        'template_id',
        'estatus',
        'color',
        'valor',
        'descripcion',
    ];
}
