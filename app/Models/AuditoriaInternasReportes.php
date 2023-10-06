<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaInternasReportes extends Model
{
    use HasFactory;

    public $table = "auditoria_internas_reportes";

    protected $fillable = [
        "id_auditoria",
        "empleado_id",
        "lider_id",
        "comentarios",
        "estado",
        "firma",
        "reporte_id"
    ];
}
