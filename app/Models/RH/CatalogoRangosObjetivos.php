<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoRangosObjetivos extends Model
{
    use HasFactory;

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
