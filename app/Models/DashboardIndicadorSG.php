<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardIndicadorSG extends Model
{
    use HasFactory;

    protected $table = 'dashboard_indicadores_sgi';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'porcentaje_cumplimiento',
        'alta',
        'media',
        'baja',
    ];
}
