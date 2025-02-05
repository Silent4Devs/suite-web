<?php

namespace App\Models;

use App\Models\ContractManager\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClausulasOc extends Model
{
    use HasFactory;

    protected $table = 'clausulas_oc';

    protected $fillable = [
        'organizacion_id',
        'sucursal_id',
        'descripcion',
    ];

    // Relación con el modelo Organizacion
    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'organizacion_id');
    }

    // Relación con el modelo Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
