<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CatalogoRangosObjetivos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = "catalogo_rangos_objetivos";

    protected $fillable = [
        'nombre_catalogo',
        'descripcion',
    ];

    public function rangos()
    {
        return $this->hasMany(RangosObjetivos::class, 'catalogo_rangos_id', 'id');
    }
}
