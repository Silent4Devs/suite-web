<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class RangosObjetivos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'rangos_objetivos';

    protected $fillable = [
        'catalogo_rangos_id',
        'parametro',
        'valor',
        'color',
        'descripcion',
    ];
}
