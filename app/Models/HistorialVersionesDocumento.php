<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialVersionesDocumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['fecha'];

    protected $fillable = [
        'documento_id',
        'codigo',
        'nombre',
        'tipo',
        'macroproceso_id',
        'estatus',
        'version',
        'fecha',
        'archivo',
        'elaboro_id',
        'reviso_id',
        'aprobo_id',
        'responsable_id'
    ];

    public function documento()
    {
        return $this->belongsTo(Empleado::class, 'documento_id', 'id');
    }

    public function revisor()
    {
        return $this->belongsTo(Empleado::class, 'reviso_id', 'id');
    }

    public function macroproceso()
    {
        return $this->belongsTo(Macroproceso::class, 'macroproceso_id', 'id');
    }

    public function elaborador()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id', 'id');
    }

    public function aprobador()
    {
        return $this->belongsTo(Empleado::class, 'aprobo_id', 'id');
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id');
    }
}
