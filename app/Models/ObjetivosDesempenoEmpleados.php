<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivosDesempenoEmpleados extends Model
{
    use HasFactory;

    protected $table = 'objetivos_desempeno_empleados';

    protected $fillable = [
        'objetivo',
        'descripcion',
        'categoria_objetivo_id',
        'KPI',
        'unidad_objetivo_id',
        'empleado_id',
        'papelera',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaObjetivosDesempeno::class, 'categoria_objetivo_id', 'id');
    }

    public function unidad()
    {
        return $this->belongsTo(UnidadObjetivosDesempeno::class, 'unidad_objetivo_id', 'id');
    }
}
