<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Ev360ParametrosObjetivos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = "ev360_parametros_objetivos";

    protected $fillable = [
        'evaluacion_id',
        'parametro',
        'valor',
        'color',
        'descripcion',
    ];
}
