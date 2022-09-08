<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanAuditoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plan_auditoria';

    protected $fillable = [
        'objetivo',
        'alcance',
        'criterios',
        'documentoauditar',
        'equipoauditor',
        'descripcion',
        'fecha_auditoria',
        'fecha_inicio_auditoria',
        'fecha_fin_auditoria',
    ];

    
}
