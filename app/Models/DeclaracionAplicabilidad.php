<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeclaracionAplicabilidad extends Model
{
    use HasFactory;

    public $table = 'declaracion_aplicabilidad';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'control-uno',
        'control-dos',
        'anexo_indice',
        'control',
        'descripcion_control',
        'aplica',
        'justificacion',
        'created_at',
        'updated_at',
    ];


    public function responsables()
    {
        return $this->belongsToMany('App\Models\Empleado', 'declaracion_aplicabilidad_responsables', 'declaracion_id', 'empleado_id');
    }

    public function aprobadores()
    {
        return $this->belongsToMany('App\Models\Empleado', 'declaracion_aplicabilidad_aprobadores', 'declaracion_id','aprobadores_id');
    }
}
