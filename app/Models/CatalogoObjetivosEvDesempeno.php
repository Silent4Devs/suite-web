<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoObjetivosEvDesempeno extends Model
{
    use HasFactory;

    protected $table = 'catalogo_objetivos_ev_desempenos';

    protected $fillable = [
        'objetivo',
        'descripcion_objetivo',
        'KPI',
        'tipo_objetivo',
        'unidad_objetivo',
        'valor_maximo_unidad_objetivo',
        'valor_minimo_unidad_objetivo',
    ];

    public function escalas()
    {
        return $this->hasMany(EscalasObjCuestionarioEvDesempeno::class, 'objetivo_id', 'id');
    }
}
